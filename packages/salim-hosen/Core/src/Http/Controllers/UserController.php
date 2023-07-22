<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Core\Models\Role;
use App\Models\User;
use SalimHosen\Core\Http\Requests\User\StoreUserRequest;
use SalimHosen\Core\Models\Company;
use SalimHosen\Core\Http\Requests\User\UpdateUserRequest;
use SalimHosen\Core\Models\Contact;
use SalimHosen\Core\Models\Subrole;
use DB;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        abort_if(Gate::denies('access_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if(request("show_all") == true && getAuthRole() == "admin"){

            $users = User::with(['roles'])->get();

        }else{

            $users = User::with(['roles'])->whereHas("companies", function($q){
                $q->where("id", getCompanyId());
            })->get();

        }

        return view('core::users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('create_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');
        $subroles = Subrole::where("company_id", getCompanyId())->get();
        // $companies = Company::all();
        return view('core::users.create', compact('subroles', 'roles'));
        // return view('core::users.create', compact('roles', 'companies', 'subroles'));
    }

    public function store(StoreUserRequest $request)
    {
        abort_if(Gate::denies('create_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        DB::beginTransaction();
        try{


            $user = User::create($request->all());


            // attach main role
            $role = Role::where("title", getAuthRole())->first();
            $user->roles()->attach($role->id);

            // $user->roles()->sync($request->input('roles', []));

            $company = [];
            $company[getCompanyId()] = ["subrole_id" => $request->role == 0 ? null : $request->role];
            $user->companies()->attach($company);

            // 0=Account, 1=Contact, 2=Delivery Address
            Contact::create([
                "user_id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "phone" => $user->phone,
                "contact_source" => 'admin',
                'contact_type' => 1,
                'is_default_contact' => true
            ]);

            DB::commit();
            return redirect()->route('users.index')->with("success", __("Created Sucessfully"));
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }

    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('edit_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $roles = Role::pluck('title', 'id');

        // $user->load('roles');
        // $companies = Company::all();
        $subroles = Subrole::where("company_id", getCompanyId())->get();
        $company_user = DB::table('company_user')->where("user_id", $user->id)
                                ->where("company_id", getCompanyId())->first();

        return view('core::users.edit', compact('subroles', 'user', 'company_user'));
        // return view('core::users.edit', compact('roles', 'user', 'companies'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        abort_if(Gate::denies('edit_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($request->password){
            $user->update($request->all());
        }else{
            $user->update($request->except(["password"]));
        }

        DB::table('company_user')->where("user_id", $user->id)
            ->where("company_id", getCompanyId())->update([
                "subrole_id" => $request->role == 0 ? null : $request->role
            ]);


        // $user->companies()->sync($request->input('company', []));
        // $user->roles()->sync($request->input('roles', []));

        return redirect()->route('users.index')->with("success", __("Updated Sucessfully"));
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('access_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');

        return view('core::users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('delete_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Contact::where("user_id", $user->id)->delete();
        $user->delete();

        return redirect()->route('users.index')->with("success", __("Deleted Sucessfully"));
    }


}

<?php

namespace SalimHosen\Core\Seeders;

use SalimHosen\Core\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use SalimHosen\Core\Models\Contact;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::first();
        $company = Company::first();

        Contact::create([
            "name" => $admin->name,
            "user_id" => $admin->id,
            "email" => $admin->email,
            "company_id" => $company->id,
            "contact_type" => "Account"
        ]);
    }
}

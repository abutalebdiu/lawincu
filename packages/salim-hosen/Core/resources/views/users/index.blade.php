@extends(getLayout())

@section('meta_tags')
    <title>{{ __("User List") }}</title>
    <meta name="description" content="User List and Manage User Details">
    <meta name="keywords" content="user,user_list">
@endsection

@section('content')

    @can("create_user")
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('users.create') }}">
                {{ __('Create User') }}
            </a>
        </div>
    </div>
    @endcan

    <div class="card">
        <div class="card-header border-0">
            {{ __('User List') }}
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ __('ID') }}
                            </th>
                            <th>
                                {{ __('Name') }}
                            </th>
                            <th>
                                {{ __('Email') }}
                            </th>
                            <th>
                                {{ __('Email Verified At') }}
                            </th>
                            <th>
                                {{ __('Roles') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $user->id ?? '' }}
                                </td>
                                <td>
                                    {{ $user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $user->email ?? '' }}
                                </td>
                                <td>
                                    {{ $user->email_verified_at ?? '' }}
                                </td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <span class="badge bg-info">{{ $role->title }}</span>
                                    @endforeach
                                </td>
                                <td>

                                    @can("see_users")
                                    <a class="btn btn-xs btn-primary" href="{{ route('users.show', $user->id) }}">
                                        {{ __('View') }}
                                    </a>
                                    @endcan

                                    @can("edit_user")
                                    <a class="btn btn-xs btn-info" href="{{ route('users.edit', $user->id) }}">
                                        {{ __('Edit') }}
                                    </a>
                                    @endcan

                                    @can("delete_user")
                                        @if (Auth::user()->id != $user->id)
                                            <x-core-delete-dialog :id="$user->id" :action="route('users.destroy', $user->id)">
                                            </x-core-delete-dialog>
                                        @endif
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection



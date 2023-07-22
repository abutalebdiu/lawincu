@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("Role Details") }}</title>
    <meta name="description" content="Role Details">
    <meta name="keywords" content="role,role_show">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ __('Role List') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('roles.index') }}">
                    {{ __('Back to List') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ __('ID') }}
                        </th>
                        <td>
                            {{ $role->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Title') }}
                        </th>
                        <td>
                            {{ $role->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Parent Role') }}
                        </th>
                        <td>
                            {{ $role->parent_role->title ?? "" }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Permissions') }}
                        </th>
                        <td>
                            @foreach($role->permissions as $key => $permissions)
                                <span class="badge bg-info">{{ $permissions->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('roles.index') }}">
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

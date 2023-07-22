@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("Role List") }}</title>
    <meta name="description" content="Role List and Manage Role Details">
    <meta name="keywords" content="role,role_list">
@endsection

@section('content')

<div class="card">
    <div class="card-header border-0">
        {{ __('Role List') }}
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
                            {{ __('Title') }}
                        </th>
                        <th>
                            {{ __('Permissions') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $key => $role)
                        <tr data-entry-id="{{ $role->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $role->id ?? '' }}
                            </td>
                            <td>
                                {{ $role->title ?? '' }}
                            </td>
                            <td>
                                @foreach($role->permissions as $key => $item)
                                    <span class="badge bg-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                    @can("create_role")
                                        <a class="btn btn-sm btn-primary mb-2" href="{{ route('roles.show', $role->id) }}">
                                            {{ __('View') }}
                                        </a>
                                    @endcan

                                    @can("edit_role")
                                        <a class="btn btn-sm btn-info mb-2" href="{{ route('roles.edit', $role->id) }}">
                                            {{ __('Edit') }}
                                        </a>
                                    @endcan

                                    @if ($role->role_id != 0)
                                        <x-core-delete-dialog :id="$role->id" :action="route('roles.destroy', $role->id)"></x-core-delete-dialog>
                                    @endif

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection


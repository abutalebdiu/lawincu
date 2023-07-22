@extends(getLayout())


@section("meta_tags")
<title>{{ __("Subrole List") }}</title>
    <meta name="description" content="Role List and Manage Role Details">
    <meta name="keywords" content="role,role_list">
@endsection

@section('content')

@can("create_subrole")
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('subroles.create') }}">
            {{ __('Create Role') }}
        </a>
    </div>
</div>
@endcan

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
                    @foreach($subroles as $key => $role)
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
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                    @can("access_subrole")
                                    <a class="btn btn-xs btn-primary" href="{{ route('subroles.show', $role->id) }}">
                                        {{ __('View') }}
                                    </a>
                                    @endcan

                                    @can("edit_subrole")
                                    <a class="btn btn-xs btn-info" href="{{ route('subroles.edit', $role->id) }}">
                                        {{ __('Edit') }}
                                    </a>
                                    @endcan

                                    @can("delete_subrole")
                                        <x-core-delete-dialog :id="$role->id" :action="route('subroles.destroy', $role->id)"></x-core-delete-dialog>
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


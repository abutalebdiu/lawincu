@extends('core::layouts.admin')

@section("title", "Permission List")

@section("meta_tags")
    <meta name="description" content="Permission List and Manage Permission List Details">
    <meta name="keywords" content="permission,permission_list">
@endsection

@section('content')

{{-- <div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('permissions.create') }}">
            {{ __('Create Permission') }}
        </a>
    </div>
</div> --}}

<div class="card">
    <div class="card-header border-0">
        {{ __('Permission List') }}
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
                        {{-- <th>
                            &nbsp;
                        </th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $key => $permission)
                        <tr data-entry-id="{{ $permission->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $permission->id ?? '' }}
                            </td>
                            <td>
                                {{ $permission->title ?? '' }}
                            </td>
                            {{-- <td>

                                    <a class="btn btn-xs btn-info" href="{{ route('permissions.edit', $permission->id) }}">
                                        {{ __('Edit') }}
                                    </a>

                                    <x-core-delete-dialog :id="$permission->id" :action="route('permissions.destroy', $permission->id)"></x-core-delete-dialog>

                            </td> --}}

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection


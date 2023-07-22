@extends('core::layouts.admin')

@section("title", "Permission Details")

@section("meta_tags")
    <meta name="description" content=" Permission Details">
    <meta name="keywords" content="permission,permission_show">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ __('Permission List') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('permissions.index') }}">
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
                            {{ $permission->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Title') }}
                        </th>
                        <td>
                            {{ $permission->title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('permissions.index') }}">
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

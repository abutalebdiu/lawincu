@extends('core::layouts.admin')


@section("meta_tags")
    <title>{{ __("City Details") }}</title>
    <meta name="description" content="City Details">
    <meta name="keywords" content="city,city_show">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ __("City Details") }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.permissions.index') }}">
                    {{ __("Back_to _list") }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ __("ID") }}
                        </th>
                        <td>
                            {{ $state->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __("City Name") }}
                        </th>
                        <td>
                            <span class="btn btn-info btn-xs">{{ $state->name }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.permissions.index') }}">
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

@extends('core::layouts.admin')


@section("meta_tags")
    <title>{{ __("Country Details") }}</title>
    <meta name="description" content=" Country Details">
    <meta name="keywords" content="country,country_show">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ __("Country Details") }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.permissions.index') }}">
                    {{ __("Back to List") }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ __("ID") }}
                        </th>
                        <td>
                            {{ $country['id'] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __("Country Name") }}
                        </th>
                        <td>
                            <span class="btn btn-info btn-xs">{{ $country['name'] }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.permissions.index') }}">
                    {{ __("Back_to_list") }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

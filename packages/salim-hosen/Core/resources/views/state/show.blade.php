@extends('core::layouts.admin')


@section("meta_tags")
    <title>{{ __("State Details") }}</title>
    <meta name="description" content="State Details">
    <meta name="keywords" content="state,state_show">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ __("State List") }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.permissions.index') }}">
                    {{ __("Back_to_list") }}
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
                            {{ __('State Name') }}
                        </th>
                        <td>
                            <span class="btn btn-info btn-xs">{{ $state->name }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.permissions.index') }}">
                    {{ trans('Back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

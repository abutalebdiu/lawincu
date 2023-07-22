@extends('core::layouts.admin')


@section("meta_tags")
    <title>{{ __("City List") }}</title>
    <meta name="description" content="City List and Manage City Details">
    <meta name="keywords" content="city,city_list">
@endsection


@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('cities.create') }}">
                {{ __("Create City") }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header border-0">
        {{ __("City List") }}
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ __("Name") }}
                        </th>
                        <th>
                            {{ __("City") }}
                        </th>
                        <th>
                            {{ __("State") }}
                        </th>
                        <th>
                            {{ __("Country") }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cities as $key => $city)
                        <tr data-entry-id="{{ $city->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ $city->name }}
                            </td>
                            <td>
                                {{ $city->state->name ?? '' }}
                            </td>
                            <td>
                                {{ $city->country->name ?? '' }}
                            </td>
                            <td>

                                    <a class="btn btn-xs btn-info" href="{{ route('cities.edit', $city->id) }}">
                                        {{ __("Edit") }}
                                    </a>

                                <x-core-delete-dialog :id="$city->id" :action="route('cities.destroy', $city->id)"></x-core-delete-dialog>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('body_scripts')

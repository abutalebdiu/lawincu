@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("Country List") }}</title>
    <meta name="description" content="Country List and Manage Country Details">
    <meta name="keywords" content="country,country_list">
@endsection

@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <div class="d-flex align-items-center justify-content-between">
            <a class="btn btn-success" href="{{ route('countries.create') }}">
                {{ __("Create Country") }}
            </a>

            <form action="{{ route('countries.index') }}" method="GET" class="d-flex align-items-center">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="q" placeholder="{{__("Search")}}" value="{{ request('q') }}">
                    <button class="btn btn-primary btn-sm" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header border-0">
        {{ __("Country List") }}
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ __("#") }}
                        </th>
                        <th>
                            {{ __("Name") }}
                        </th>
                        <th>
                            {{ __("Flag") }}
                        </th>
                        <th>
                            {{ __("ISO2") }}
                        </th>
                        <th>
                            {{ __("ISO3") }}
                        </th>
                        <th>
                            {{ __("Country Code") }}
                        </th>
                        <th>
                            {{ __("Status") }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($countries as $key => $country)
                        <tr data-entry-id="{{ $country['id'] }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ $country->name }}
                            </td>
                            <td>
                                <img width="40" src="{{ asset("uploads/flag/$country->flag") }}" class="img-fluid" alt="">
                            </td>
                            <td>
                                {{ $country->iso_code_2 }}
                            </td>
                            <td>
                                {{ $country->iso_code_3 }}
                            </td>
                            <td>
                                {{ $country->country_code }}
                            </td>
                            <td>
                                @if ($country->is_active)
                                    <span class="badge bg-primary">{{ __("Active") }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __("Inactive") }}</span>
                                @endif
                            </td>
                            <td>


                                    <a class="btn btn-xs btn-info" href="{{ route('countries.edit', $country->id) }}">
                                        {{ __("Edit") }}
                                    </a>



                                    <x-core-delete-dialog :id="$country->id" :action="route('countries.destroy', $country->id)"></x-core-delete-dialog>


                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $countries->links() }}

        </div>
    </div>
</div>


@endsection

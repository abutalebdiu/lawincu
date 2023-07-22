@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("State List") }}</title>
    <meta name="description" content="List State and Manage State Details">
    <meta name="keywords" content="state,state_list">
@endsection

@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('states.create') }}">
                {{ __("Create State") }}
            </a>
        </div>
    </div>


<div class="card">
    <div class="card-header border-0">
        {{ __("State List") }}
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ __("#") }}
                        </th>
                        <th>
                            {{ __("State Name") }}
                        </th>
                        <th>
                            {{ __("State Name") }} ({{ __("Arabic") }})
                        </th>

                        <th>
                            {{ __("Country Name") }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($states as $key => $state)
                        <tr data-entry-id="{{ $state->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $state->id }}
                            </td>
                            <td>
                                {{ $state->name }}
                            </td>
                            <td>
                                {{ $state->arabic_name }}
                            </td>

                            <td>
                                {{ $state->country->name ?? "" }}
                            </td>

                            <td>



                                <a class="btn btn-xs btn-info" href="{{ route('states.edit', $state->id) }}">
                                    {{ trans('Edit') }}
                                </a>



                                <x-core-delete-dialog :id="$state->id" :action="route('states.destroy', $state->id)"></x-core-delete-dialog>



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

    @include("core::partials.datatable")

    <script>
        $(function() {

            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-User:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endpush

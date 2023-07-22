@extends('core::layouts.admin')



@section("meta_tags")
<title>{{ __("Currency List") }}</title>
    <meta name="description" content="Currency List and Manage Currency Details">
    <meta name="keywords" content="currency,currency_list">
@endsection


@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('currencies.create') }}">
                {{ __("Create Currency") }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header border-0">
        {{ __("Currency List") }}
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
                            {{ __("Code") }}
                        </th>
                        <th>
                            {{ __("Symbol") }}
                        </th>
                        <th>
                            {{ __("Exchange Rate") }}
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
                    @foreach($currencies as $key => $currency)
                        <tr data-entry-id="{{ $currency['id'] }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ $currency['name'] ?? '' }}
                            </td>
                            <td>
                                {{ $currency['code'] ?? '' }}
                            </td>
                            <td>
                                {{ $currency['symbol'] ?? '' }}
                            </td>
                            <td>
                                {{ $currency['exchange_rate'] ?? '' }}
                            </td>

                            {{-- <td>
                                {{ $currency->position == 'l' ? 'Left' : "Right" }}
                            </td> --}}
                            <td>
                                @if ($currency['is_active'])
                                    <span class="badge bg-info">{{ __("active") }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __("inactive") }}</span>
                                @endif
                            </td>
                            <td>


                                @if ($currency->code != config('settings.currency'))
                                    <a class="btn btn-xs btn-primary" href="{{ route('currencies.edit', $currency['id']) }}">
                                        {{ __("Edit") }}
                                    </a>
                                    <x-core-delete-dialog :id="$currency['id']" :action="route('currencies.destroy', $currency->id)"></x-core-delete-dialog>
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


@push('body_scripts')

<script>
    $(function () {

        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        });

        let table = $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })

        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

    });



</script>
@endpush

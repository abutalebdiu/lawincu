@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("Mailing List") }}</title>
    <meta name="description" content="Mailing List and Manage Mailing List Details">
    <meta name="keywords" content="mailinglist,mailinglist_list">
@endsection


@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('mailing-lists.create') }}">
                {{ __('Create Mailing List') }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        {{ __("Mailing List") }}
    </div>

    <div class="card-body">

        <div class="row">

            @foreach ($lists as $list)
                <div class="col-md-4 mb-3">
                    <ul style="list-style: none">
                        <li class="d-flex align-items-center justify-content-between mb-1">
                            <a href="{{ route("mailing-lists.show", $list->id) }}">
                                <h6>{{ $list->name }}</h6>
                            </a>

                            <span>
                                <a class="btn btn-xs btn-info" href="{{ route('mailing-lists.edit', $list->id) }}">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <x-core-delete-dialog label="icon" :id="$list->id" :action="route('mailing-lists.destroy', $list->id)"></x-core-delete-dialog>
                            </span>
                        </li>
                        @foreach ($list->mailing_sublist as $child)
                            <li class="d-flex align-items-center pl-4 mb-1 justify-content-between">
                                <a href="">
                                    {{ $child->name }}
                                </a>

                                <span>
                                    <a class="btn btn-xs btn-info" href="{{ route('mailing-lists.edit', $child->id) }}">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <x-core-delete-dialog
                                        label="icon"
                                        :id="$child->id"
                                        :action="route('mailing-lists.destroy', $child->id)"
                                    ></x-core-delete-dialog>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

        </div>

        {{-- <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
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
                            {{ __("Folder") }}
                        </th>

                        <th>
                            {{ __("Total Subscribers") }}
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lists as $list)
                        <tr data-entry-id="{{ $list->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>

                            <td>
                                {{ $list->name ?? '' }}
                            </td>

                            <td>
                                {{ $list->folder->name ?? '' }}
                            </td>

                            <td>
                                {{ $list->contacts()->count() }}
                            </td>

                            <td>

                                <a class="btn btn-xs btn-info" href="{{ route('mailing-lists.show', $list->id) }}">
                                    {{ __('View') }}
                                </a>
                                <a class="btn btn-xs btn-primary" href="{{ route('mailing-lists.edit', $list->id) }}">
                                    {{ __('Edit') }}
                                </a>
                                <x-core-delete-dialog :id="$list->id" :action="route('mailing-lists.destroy', $list->id)"></x-core-delete-dialog>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}
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
                    [1, 'asc']
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

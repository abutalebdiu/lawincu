@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("Contact List") }}</title>
    <meta name="description" content="Create Contact and Manage Contact Details">
    <meta name="keywords" content="contact,contact_list">
@endsection

@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('contacts.create') }}">
                {{ __('Create Contact') }}
            </a>
            <a class="ml-2 btn btn-primary" href="{{ route('contacts.import') }}">
                {{ __('Import Contacts') }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        {{ __("Contact List") }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ __("#") }}
                        </th>

                        <th>
                            {{ __("First Name") }}
                        </th>
                        <th>
                            {{ __("Last Name") }}
                        </th>
                        <th>
                            {{ __("Email") }}
                        </th>
                        <th>
                            {{ __("Phone") }}
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr data-entry-id="{{ $contact['id'] }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>

                            <td>
                                {{ $contact["attributes"]->FIRSTNAME ?? '' }}
                            </td>
                            <td>
                                {{ $contact["attributes"]->LASTNAME ?? '' }}
                            </td>
                            <td>
                                {{ $contact['email'] ?? '' }}
                            </td>
                            <td>
                                {{ $contact["attributes"]->SMS ?? '' }}
                            </td>

                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('contacts.edit', $contact['id']) }}">
                                    {{ __('Edit') }}
                                </a>
                                <x-core-delete-dialog :id="$contact['id']" :action="route('contacts.destroy', $contact['id'])"></x-core-delete-dialog>
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

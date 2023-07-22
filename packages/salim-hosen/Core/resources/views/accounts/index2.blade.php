@extends(getLayout())

@section("meta_tags")
    <title>{{ __("Account List") }}</title>
    <meta name="description" content="Account List and Manage Contact Details">
    <meta name="keywords" content="Account,Accountlist">
@endsection

@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('accounts.create') }}">
                {{ __("Create Account") }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#bulkImportModal">
                {{ __('Bulk Import') }}
            </button>
            @include('core::bulkImport.modal', [
                'model' => 'SalimHosen\Core\Models\Contact',
                'view' => 'bulkImport.parseInput',
                'redirect_url' => route("accounts.index"),
                'post_route' => route("accounts.store")
            ])
        </div>
    </div>

<div class="card">
    <div class="card-header">
        {{ __("Account List") }}
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Permission">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ __("#") }}
                        </th>

                        <th>
                            {{ __("Contact Type") }}
                        </th>

                        <th>
                            {{ __("Image") }}
                        </th>

                        <th>
                            {{ __("Name") }}
                        </th>

                        <th>
                            {{ __("Email") }}
                        </th>

                        <th>
                            {{ __("Phone") }}
                        </th>

                        <th>
                            {{ __("Mobile") }}
                        </th>

                        <th>
                            {{ __("Website") }}
                        </th>

                        <th>
                            {{ __("Country") }}
                        </th>

                        <th>
                            {{ __("State") }}
                        </th>

                        <th>
                            {{ __("Street Address 1") }}
                        </th>

                        <th>
                            {{ __("Street Address 2") }}
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>


@endsection



@push('body_scripts')

    @include("core::partials.datatable")

    <script>
        $(function () {

            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)


  let deleteButton = {
    text: '{{ __("Delete") }}',
    url: "{{ route('api.accounts.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ __("zero rows selected") }}')

        return
      }

      if (confirm('{{ __("Are you sure?") }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)


      let dtOverrideGlobals = {
        buttons: dtButtons,
        processing: true,
        serverSide: true,
        retrieve: true,
        aaSorting: [],
        ajax: "{{ route('accounts.index') }}",
        columns: [
            { data: 'placeholder', name: 'placeholder' },
            { data: 'id', name: 'id' },
            { data: 'contact_type', name: 'contact_type' },
            { data: 'image', name: 'image', render: function( data, type, full, meta ) {
                return "<img src=\"" + data + "\" height=\"50\"/>";
            }},
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'mobile', name: 'mobile' },
            { data: 'website', name: 'website' },
            { data: 'country', name: 'country.name' },
            { data: 'state', name: 'state.name' },
            { data: 'address', name: 'address' },
            { data: 'address_2', name: 'address_2' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false},
                ],
                orderCellsTop: true,
                order: [[ 1, 'asc' ]],
                pageLength: 50,
            };
            let table = $('.datatable-Permission').DataTable(dtOverrideGlobals);
                $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                    $($.fn.dataTable.tables(true)).DataTable()
                        .columns.adjust();
            });

        });

    </script>
@endpush


@extends(getLayout())


@section("meta_tags")
    <title>{{ __("Company List") }}</title>
    <meta name="description" content="Company List and Manage Company Details">
    <meta name="keywords" content="company,company_list">
@endsection

@section('content')

    <div style="margin-bottom: 10px;">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <a class="btn btn-success" href="{{ route('companies.create') }}">
                    {{ __("Create Company") }}
                </a>
            </div>
            <div>
                <div class="form-check">
                    <input onchange="window.location.href='{{ route('companies.index') }}?inactive='+event.target.checked" class="form-check-input" type="checkbox" value="" id="flexCheckChecked" @if(request('inactive')=='true') checked @endif>
                    <label class="form-check-label" for="flexCheckChecked">
                      {{ __("Show Only Inactive Companies") }}
                    </label>
                </div>
            </div>
        </div>
    </div>

<div class="card">
    <div class="card-header border-0">
        {{ __("Company List") }}
    </div>

    <div class="card-body p-0">

        @if(session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif

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
                            {{ __("Logo") }}
                        </th>

                        <th>
                            {{ __("Company Name") }}
                        </th>

                        <th>
                            {{ __("Email") }}
                        </th>
                        <th>
                            {{ __("Phone") }}
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
                    @foreach($companies as $key => $company)
                        <tr data-entry-id="{{ $company->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>

                            <td>
                                <img width="50" src="{{ asset($company->logo ? "uploads/logo/$company->logo" : "images/company.png") }}" alt="Company image" class="img-fluid">
                            </td>

                            <td>
                                {{ $company->name ?? '' }}
                            </td>

                            <td>
                                {{ $company->contact->email ?? "" }}
                            </td>

                            <td>
                                {{ $company->contact->phone ?? ""}}
                            </td>

                            <td>
                                @if ($company->id != 1)
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input activate-company" data-id="{{ $company->id }}" name="is_active" value="1" type="checkbox"  @if ($company->is_active) checked @endif>
                                    </div>
                                </div>
                                @endif
                            </td>

                            <td>
                                <a class="btn btn-xs btn-info" href="{{ route('companies.show', $company->id) }}">
                                    {{ __("View") }}
                                </a>
                                <a class="btn btn-xs btn-primary" href="{{ route('companies.edit', $company->id) }}">
                                    {{ __("Edit") }}
                                </a>

                                @if ($company->id != 1)
                                    <x-core-delete-dialog :id="$company->id" :action="route('companies.destroy', $company->id)"></x-core-delete-dialog>
                                @endif

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            {{__("Showing ")}} {{ $companies->firstItem() }} to {{ $companies->lastItem() }} {{ __(" of total ") }} {{ $companies->total() }}
          </div>
          <nav aria-label="..." class="justify-content-end mb-0">
            {{ $companies->links() }}
          </nav>
        </div>
      </div>
</div>


@endsection




@push('body_scripts')

    <script>
        $(document).ready(function(){

            $(document).on("change", ".activate-company", function(){

                const company_id = $(this).data("id");

                $.ajax({
                    url: "{{ route('company.activate') }}",
                    type: "post",
                    data: {company_id: company_id, _token: "{{ csrf_token() }}"} ,
                    success: function (response) {
                        toastr.success(response.message);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });

            });

        });
    </script>
@endpush

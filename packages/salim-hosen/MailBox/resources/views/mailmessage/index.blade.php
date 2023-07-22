@extends(getLayout())


@section("meta_tags")
    <title>{{ __("Mailmessage List") }}</title>
    <meta name="description" content="Mailmessage List and Manage Mailmessage Details">
    <meta name="keywords" content="mailmessage,mailmessage_list">
@endsection

@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('companies.create') }}">
                {{ __("Create Company") }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        {{ __("Stage List") }}
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif

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
                            {{ __("Company Name") }}
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
                    @foreach($companies as $key => $company)
                        <tr data-entry-id="{{ $company->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>

                            <td>
                                {{ $company->name ?? '' }}
                            </td>

                            <td>
                                {{ $company->email }}
                            </td>

                            <td>
                                {{ $company->phone}}
                            </td>

                            <td>

                                <a class="btn btn-xs btn-primary" href="{{ route('companies.edit', $company->id) }}">
                                    {{ __("Edit") }}
                                </a>

                                @if ($loop->index != 0)
                                <x-core-delete-dialog :id="$company->id" :action="route('companies.destroy', $company->id)"></x-core-delete-dialog>
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




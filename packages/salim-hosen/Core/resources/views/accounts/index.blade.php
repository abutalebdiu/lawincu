@extends(getLayout())


@section("meta_tags")
<title>{{ __("Contact List") }}</title>
    <meta name="description" content="Contact List and Manage Contact Details">
    <meta name="keywords" content="contact,contact_list">
@endsection

@section('content')

<div class="d-flex mb-3 align-items-center justify-content-between">
    <div>
        <a class="btn btn-success" href="{{ route('accounts.create') }}">
            {{ __("Create Account") }}
        </a>
        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#bulkImportModal">
            {{ __('Bulk Import') }}
        </button>
        @include('core::bulkImport.modal', [
            'model' => 'SalimHosen\Core\Models\Contact',
            'view' => 'bulkImport.parseInput',
            'redirect_url' => route("accounts.addto.list"),
            'post_route' => route("accounts.store"),
            'additional_data' => json_encode(["contact_type" => 0])
        ])
    </div>
    <div>
        <form action="{{ route('accounts.index') }}" method="GET" class="d-flex align-items-center">
            <div class="input-group">
                <input type="text" class="form-control" name="q" placeholder="{{ __("Search") }}" value="{{ request('q') }}">
                <button class="btn btn-primary btn-sm" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header border-0">
        {{ __("Account List") }}
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
                            {{ __("Country") }}
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $account)
                        <tr>
                            <td></td>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                <img src="{{ asset($account->image ? "images/contact/$account->image" : "images/company.png") }}" alt="" width="50">
                            </td>
                            <td>{{ $account->name }}</td>
                            <td>{{ $account->email }}</td>
                            <td>{{ $account->phone }}</td>
                            <td>{{ $account->country->name ?? "" }}</td>
                            <td>
                                <a class="btn btn-xs btn-info" href="{{ route('accounts.edit', $account->id) }}">
                                    {{ __("Edit") }}
                                </a>
                                @if (!$account->is_default_contact)
                                    <x-core-delete-dialog :id="$account->id" :action="route('accounts.destroy', $account->id)"></x-core-delete-dialog>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $accounts->links() }}
        </div>
    </div>
    <div class="card-footer">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            {{__("Showing ")}} {{ $accounts->firstItem() ?? 0 }} to {{ $accounts->lastItem() ?? 0 }} {{ __(" of total ") }} {{ $accounts->total() }}
          </div>
          <nav aria-label="..." class="justify-content-end mb-0">
            {{ $accounts->links() }}
          </nav>
        </div>
      </div>
</div>

@endsection


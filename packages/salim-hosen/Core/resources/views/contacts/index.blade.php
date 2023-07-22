@extends(getLayout())


@section("meta_tags")
<title>{{ __("Contact List") }}</title>
    <meta name="description" content="Contact List and Manage Contact Details">
    <meta name="keywords" content="contact,contact_list">
@endsection

@section('content')

    <div class="d-flex mb-3 align-items-center justify-content-between">
        <div>
            <a class="btn btn-success" href="{{ route('contacts.create') }}">
                {{ __("Create Contact") }}
            </a>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#bulkImportModal">
                {{ __('Bulk Import') }}
            </button>
            @include('core::bulkImport.modal', [
                'model' => 'SalimHosen\Core\Models\Contact',
                'view' => 'bulkImport.parseInput',
                'redirect_url' => route("contacts.addto.list"),
                'post_route' => route("contacts.store"),
                'additional_data' => json_encode(["contact_type" => 1])
            ])

            {{-- <a class="btn btn-primary" href="{{ asset('asougexpress/documents/Bulk-Contact-Upload.csv') }}" download="download">
                {{ __("Download Upload Format") }}
            </a> --}}
        </div>
        <div>
            <form action="{{ route('contacts.index') }}" method="GET" class="d-flex align-items-center">
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
        {{ __("Contact List") }}
    </div>

    <div class="card-body p-0">

        @if(session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table ">
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
                    @foreach ($contacts as $contact)
                        <tr>
                            <td></td>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                <img src="{{ asset($contact->image ? "images/contact/$contact->image" : "images/avatar.png") }}" alt="" width="50">
                            </td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->country->name ?? "" }}</td>
                            <td>
                                <a class="btn btn-xs btn-info" href="{{ route('contacts.edit', $contact->id) }}">
                                    {{ __("Edit") }}
                                </a>
                                @if (!$contact->is_default_contact)
                                    <x-core-delete-dialog :id="$contact->id" :action="route('contacts.destroy', $contact->id)"></x-core-delete-dialog>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $contacts->links() }}
        </div>
    </div>

    <div class="card-footer">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            {{__("Showing ")}} {{ $contacts->firstItem() ?? 0 }} to {{ $contacts->lastItem() ?? 0 }} {{ __(" of total ") }} {{ $contacts->total() }}
          </div>
          <nav aria-label="..." class="justify-content-end mb-0">
            {{ $contacts->links() }}
          </nav>
        </div>
      </div>
</div>


@endsection


@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("Mailing List Details") }}</title>
    <meta name="description" content="Mailing List and Manage Mailing List Details">
    <meta name="keywords" content="mailinglist,mailinglist_list">
@endsection


@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <div class="d-flex align-items-center justify-content-between">
                <h3>{{ __("Total ") }} {{ $contacts->total() }} {{ __(" Contacts Found in ") }} {{ $mailingList->name }}</h3>
                <form action="{{ route("mailing-lists.show", $mailingList->id) }}" class="d-flex align-items-center">
                    <input type="text" name="q" placeholder="{{ __("Search Here") }}" class="form-control">
                    <button type="submit" class="btn btn-primary ms-1">{{ __("Search") }}</button>
                    @if (request('q'))
                        <a href="{{ route("mailing-lists.show", $mailingList->id) }}" class="btn btn-danger ms-1">{{ __("Reset") }}</a>
                    @endif
                </form>
            </div>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        {{ $mailingList->name }}
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
                            {{ __("Name") }}
                        </th>

                        <th>
                            {{ __("Email") }}
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr data-entry-id="{{ $contact->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>

                            <td>
                                <a href="{{ route("contacts.show", $contact->id) }}">
                                    {{ $contact->name ?? '' }}
                                </a>
                            </td>

                            <td>
                                {{ $contact->email ?? '' }}
                            </td>

                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('contacts.edit', $contact->id) }}">
                                    {{ __('Edit') }}
                                </a>
                                <x-core-delete-dialog :id="$contact->id" :action="route('contacts.destroy', $contact->id)"></x-core-delete-dialog>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $contacts->links() }}
        </div>
    </div>
</div>

@endsection




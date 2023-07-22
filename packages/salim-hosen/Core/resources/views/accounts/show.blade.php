@extends(getLayout())


@section("meta_tags")
    <title>{{ __("Account Details") }}</title>
    <meta name="description" content="Contact Details and Manage Contact Details">
    <meta name="keywords" content="contact,contact_details">
@endsection

@section("content")

<section class="content" style="padding-top: 20px">

    <div class="d-flex justify-content-between">
        <a class="btn btn-secondary mb-3" href="{{ route("contacts.index") }}">
            Back to list
        </a>
        <div>
            <a class="btn btn-info mb-3" href="{{ route("address.create", ["contact" => $contact->id]) }}">
                Add an Address
            </a>
            <a class="btn btn-primary mb-3" href="{{ route("mail-message.index", ["email" => $contact->email]) }}">
                Send Message
            </a>
            {{-- <a class="btn btn-info mb-3" href="{{ route("contacts.index") }}">
                Schedule Activity
            </a> --}}
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Contact Details
        </div>

        <div class="card-body">
            <div class="mb-2">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                Contact Type
                            </th>
                            <td>
                                {{ $contact->contact_type }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Title
                            </th>
                            <td>
                                {{ $contact->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Name
                            </th>
                            <td>
                                {{ $contact->name }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Gender
                            </th>
                            <td>
                                {{ $contact->gender }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                Nationality
                            </th>
                            <td>
                                {{ $contact->nationality }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                NID
                            </th>
                            <td>
                                {{ $contact->nid }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Email
                            </th>
                            <td>
                                {{ $contact->email }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Phone
                            </th>
                            <td>
                                {{ $contact->phone }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Mobile
                            </th>
                            <td>
                                {{ $contact->mobile }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Street Address1
                            </th>
                            <td>
                                {{ $contact->address }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Street Address2
                            </th>
                            <td>
                                {{ $contact->address_2 }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Country ID
                            </th>
                            <td>
                                {{ $contact->country->name ?? "" }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                State ID
                            </th>
                            <td>
                                {{ $contact->state->name ?? "" }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                City
                            </th>
                            <td>
                                {{ $contact->city }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Website
                            </th>
                            <td>
                                {{ $contact->website }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                NID
                            </th>
                            <td>
                                {{ $contact->nid }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Tags
                            </th>
                            <td>
                                {{ $contact->tags }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Job Position
                            </th>
                            <td>
                                {{ $contact->job_position }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __("Tax ID") }}
                            </th>
                            <td>
                                {{ $contact->tax_id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Image
                            </th>
                            <td>
                                <a target="_blank" href="{{ asset($contact->image ? "images/contact/$contact->image" : "images/contact.png") }}">
                                    <img width="50" src="{{ asset($contact->image ? "images/contact/$contact->image" : "images/contact.png") }}" alt="Slider image" class="img-fluid">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Notes
                            </th>
                            <td>
                                {{ $contact->notes }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Contact Source
                            </th>
                            <td>
                                {{ $contact->contact_source }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Addresses
                            </th>
                            <td>
                                <div class="row">
                                    @foreach ($addresses as $address)
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-end">
                                                        <a href="{{ route("address.edit", $address->id) }}" class="btn btn-secondary btn-xs"><i class="fas fa-pen m-0"></i></a>
                                                        <span class="mx-1"></span>
                                                        <x-core-delete-dialog :id="$address->id" :action="route('address.destroy', $address->id)"></x-core-delete-dialog>
                                                    </div>
                                                    {{ $address->name }} <br/>
                                                    <a href="mailto:{{ $address->email }}">{{ $address->email }}</a><br/>
                                                    {{ $address->address }} <br/>
                                                    Phone: {{ $address->phone }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
    <a class="btn btn-secondary mb-3" href="{{ route("contacts.index") }}">
        Back to list
    </a>
                </section>


@endsection

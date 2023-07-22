@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("Lead Details") }}</title>
    <meta name="description" content="Leads Details and Manage Leads Details">
    <meta name="keywords" content="lead,lead_details">
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <a class="btn btn-secondary mb-3" href="{{ route("leads.index") }}">
        Back to list
    </a>
    <div>
        <a class="btn btn-primary mb-3" href="{{ route("mail-message.index", ["email" => $lead->email]) }}">
            Send Message
        </a>
    </div>
</div>
<div class="card">

    <div class="card-header">
        {{ __('Show') }}
    </div>

    <div class="card-body">
        <div class="form-group">

            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ __('ID') }}
                        </th>
                        <td>
                            {{ $lead->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Title') }}
                        </th>
                        <td>
                            {{ $lead->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Lead_value') }}
                        </th>
                        <td>
                            {{ $lead->lead_value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Status') }}
                        </th>
                        <td>
                            {{ $lead->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Contact') }}
                        </th>
                        <td>
                            {{ $lead->contact->contact_type ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ __('Email') }}
                        </th>
                        <td>
                            {{ $lead->email ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ __('Phone') }}
                        </th>
                        <td>
                            {{ $lead->phone ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ __('Lead_stage') }}
                        </th>
                        <td>
                            {{ $lead->lead_stage->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Lead_source') }}
                        </th>
                        <td>
                            {{ $lead->lead_source->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>



@endsection

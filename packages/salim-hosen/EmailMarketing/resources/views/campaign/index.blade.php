@extends('core::layouts.admin')

@section("meta_tags")
<title>{{ __("Campaing List") }}</title>
    <meta name="description" content="Campaing List and Manage Campaing Details">
    <meta name="keywords" content="campaing,campaing_list">
@endsection


@section('content')

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('campaigns.create') }}">
            {{ __('Create Campaign') }}
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ __("Campaign List") }}
    </div>

    <div class="card-body">
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
                            {{ __("Name") }}
                        </th>
                        <th>
                            {{ __("Sent at") }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campaigns as $campaign)
                        <tr data-entry-id="{{ $campaign['id'] }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ $campaign['name'] ?? '' }}
                            </td>

                            <td>
                                {{ $campaign->created_at->format("d-M-Y") }}
                            </td>

                            <td>
                                <a class="btn btn-xs btn-info" href="{{ route('campaigns.show', $campaign['id']) }}">
                                    {{ __('View') }}
                                </a>
                                {{-- @if ($campaign['status'] != "sent")
                                    <a class="btn btn-xs btn-primary" href="{{ route('campaigns.edit', $campaign['id']) }}">
                                        {{ __('Edit') }}
                                    </a>
                                    <x-core-delete-dialog :id="$campaign['id']" :action="route('campaigns.destroy', $campaign['id'])"></x-core-delete-dialog>
                                @endif --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection


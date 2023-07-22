@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("Sender List") }}</title>
    <meta name="description" content="Sender  List and Manage Sender Details">
    <meta name="keywords" content="sender,sender_list">
@endsection

@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('senders.create') }}">
                {{ __('Create Sender') }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header border-0">
        {{ __("Sender List") }}
    </div>

    <div class="card-body p-0">
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
                            {{ __("Email") }}
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
                    @foreach($senders as $sender)
                        <tr data-entry-id="{{ $sender['id'] }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>

                            <td>
                                {{ $sender['name'] ?? '' }}
                            </td>

                            <td>
                                {{ $sender['email'] ?? '' }}
                            </td>

                            <td>
                                @if (in_array($sender['email'], $sb_senders))
                                    <span class="badge bg-success">{{ __("Verified") }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __("Not Verified") }}</span>
                                @endif

                            </td>

                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('senders.edit', $sender['id']) }}">
                                    {{ __('Edit') }}
                                </a>
                                <x-core-delete-dialog :id="$sender['id']" :action="route('senders.destroy', $sender['id'])"></x-core-delete-dialog>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection


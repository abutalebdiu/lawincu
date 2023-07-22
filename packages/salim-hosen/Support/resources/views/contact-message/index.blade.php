@extends("core::layouts.admin")


@section("meta_tags")
    <title>{{ __("Contact Message List") }}</title>
    <meta name="description" content="Contact Message List and Manage Contact Message Details">
    <meta name="keywords" content="contact_message,contact_message_list">
@endsection

@section('content')



@if(session('success'))
<div class="alert alert-success" role="alert">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-header border-0">
        {{ __('Contact Messages') }}
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ __("Serial") }}
                        </th>
                        <th>
                            {{ __("From") }}
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
                    @foreach($messages as $key => $message)
                        <tr data-entry-id="{{ $message->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ $message->first_name }}  {{ $message->last_name }}
                            </td>
                            <td>
                                @if ($message->reply_message)
                                    <span class="badge bg-success">{{ __("Replied") }}</span>
                                @else
                                    <span class="badge bg-danger">{{ __("Not Replied") }}</span>
                                @endif
                            </td>
                            <td>

                                <a class="btn btn-xs btn-primary" href="{{ route('contact-messages.show', $message->id) }}">
                                    {{ __("View") }}
                                </a>

                                <x-core-delete-dialog :id="$message->id"  :action="route('contact-messages.destroy', $message->id)"></x-core-delete-dialog>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection


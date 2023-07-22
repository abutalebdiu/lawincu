@extends(getLayout())


@section("meta_tags")
<title>{{ __("Ticket List") }}</title>
    <meta name="description" content="Ticket List and Manage Ticket Details">
    <meta name="keywords" content="ticket,ticket_list">
@endsection

@section('content')


<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('support-tickets.create') }}">
            {{ __('Create Support Ticket') }}
        </a>
    </div>
</div>


@if(session('success'))
<div class="alert alert-success" role="alert">{{ session('success') }}</div>
@endif

<div class="card border-0">
    <div class="card-header bg-white border-0">
        {{ __('Support Tickets') }}
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
                            {{ __("Product Name") }}
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
                    @foreach($tickets as $key => $ticket)
                        <tr data-entry-id="{{ $ticket->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ $ticket->issue }}
                            </td>
                            <td>

                                <span class="badge bg-{{ $ticket->status == "open" ? "primary" : "success" }}">{{ $ticket->status }}</span>

                            </td>
                            <td>

                                    <a class="btn btn-xs btn-primary" href="{{ route('support-tickets.show', $ticket->id) }}">
                                        {{ __("View") }}
                                    </a>

                                    @if (Auth::user()->hasRole("admin"))
                                    <x-core-delete-dialog :id="$ticket->id"  :action="route('support-tickets.destroy', $ticket->id)"></x-core-delete-dialog>
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


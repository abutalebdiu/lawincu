@extends(getLayout())


@section("meta_tags")
<title>{{ __("Query List") }}</title>
    <meta name="description" content="Ticket List and Manage Ticket Details">
    <meta name="keywords" content="ticket,ticket_list">
@endsection

@section('content')



@if(session('success'))
<div class="alert alert-success" role="alert">{{ session('success') }}</div>
@endif

{{-- <div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('customer-queries.create') }}">
            {{ __('Create Query') }}
        </a>
    </div>
</div> --}}

<div class="alert alert-info" role="alert">{{ __("You can send query by visiting the seller contact page") }}</div>


<div class="card">
    <div class="card-header border-0">
        {{ __('Your Queries') }}
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
                            {{ __("Query") }}
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($queries as $key => $query)
                        <tr data-entry-id="{{ $query->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ $query->customer_query }}
                            </td>

                            <td>

                                <a class="btn btn-xs btn-primary" href="{{ route('customer-queries.show', $query->id) }}">
                                    {{ __("View") }}
                                </a>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection



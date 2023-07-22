@extends("layouts.buyer")


@section("meta_tags")
    <title>{{ __("Home - Buyer") }}</title>
    <meta name="description" content="Create Employee and Manage Employee Details">
    <meta name="keywords" content="employee,employee_create">
@endsection


@section('content')

<div class="card border-0 mb-3 rounded">
    <div class="card-body">
        <h3>{{ __("Welcome") }}, {{ Auth::user()->name }}</h3>
        <p>{{ __("This is your dashboard From here you can see your order history") }}</p>
    </div>
</div>

    <div class="card border-0 mb-3">
        <div class="card-header bg-white">{{ __("Last 5 Order") }}</div>
        <div class="card-body">
            <table class="table table-responsive-sm">
                <thead>
                    <tr>
                        <th>{{ __("Order Number") }}</th>
                        <th>{{ __("Total") }}</th>
                        <th>{{ __("Ordered At") }}</th>
                        <th>{{ __("Action") }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td  colspan="4">{{ __("No Order Found") }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection

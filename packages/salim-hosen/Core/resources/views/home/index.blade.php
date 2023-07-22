@extends("core::layouts.admin")

@section("meta_tags")
    <title>{{ __("Admin Dashboard") }}</title>
    <meta name="description" content="Create Employee and Manage Employee Details">
    <meta name="keywords" content="employee,employee_create">
@endsection


@section('content')

{{-- <div class="product-tabs mb-3">
    @php
        $currentRoute = request()->route()->getName();
    @endphp
    <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link {{ $currentRoute === "products.edit" ? "active" : '' }}" aria-current="page" href="">{{ __("Activity Dashboard") }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $currentRoute === "specifications.index" ? "active" : '' }}" href="">{{ __("Marketing Dashboard") }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $currentRoute === "product-seo.index" ? "active" : '' }}" href="">{{ __("CRM Dashboard") }}</a>
          </li>
      </ul>
</div> --}}
<div class="row  mb-3">
    <div class="col-sm-6 col-lg-3">
       <div class="card text-white bg-primary">
            <div class="p-3">
                <div class="text-value-lg">{{ 0 }}</div>
                <div>{{ __("Total Products") }}</div>
            </div>
            <a href="" class="d-block bg-white text-center py-1">{{ __("More Info") }}</a>
       </div>
    </div>
    <div class="col-sm-6 col-lg-3">
       <div class="card text-white bg-info">
        <div class="p-3">
            <div class="text-value-lg">{{ 0 }}</div>
            <div>{{ __("Total Orders") }}</div>
        </div>
        <a href="" class="d-block bg-white text-center py-1">{{ __("More Info") }}</a>
       </div>
    </div>
    <div class="col-sm-6 col-lg-3">
       <div class="card text-white bg-warning">
        <div class="p-3">
            <div class="text-value-lg">{{ 0 }}</div>
            <div>{{ __("New Orders") }}</div>
        </div>
        <a href="" class="d-block bg-white text-center py-1">{{ __("More Info") }}</a>
       </div>
    </div>
    <div class="col-sm-6 col-lg-3">
       <div class="card text-white bg-danger">
            <div class="p-3">
                <div class="text-value-lg">{{ 0 }}</div>
                <div>{{ __("New Customer Queries") }}</div>
            </div>
            <a href="" class="d-block bg-white text-center py-1">{{ __("More Info") }}</a>
       </div>
    </div>
 </div>

 <div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">{{ __("Recent Orders") }}</div>
            <div class="card-body">
                <table class="table table-responsive-sm">
                    <thead>
                        <tr>
                            <th>#{{ __("Order ID") }}</th>
                            <th>{{ __("Ordered At") }}</th>
                            <th>{{ __("Total") }}</th>
                            {{-- <th>Status</th> --}}
                            <th>{{ __("Action") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4">No Result</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">{{ __("Top Selling Products") }}</div>
            <div class="card-body">
                <table class="table table-responsive-sm">
                    <thead>
                        <tr>
                            <th>#{{ __("Product Name") }}</th>
                            <th>{{ __("Action") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                       <tr>
                        <td colspan="2">No Result</td>
                       </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


@endsection


{{-- @push("body_scripts")
<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}
@endpush --}}

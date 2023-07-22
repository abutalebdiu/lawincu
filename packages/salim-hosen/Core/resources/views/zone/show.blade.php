@extends(getLayout())


@section("meta_tags")
    <title>{{ __("Zone Details") }}</title>
    <meta name="description" content="Zone Details">
    <meta name="keywords" content="zone,zone_show">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ __('Show') }} Zone Details
    </div>

    <div class="card-body">
        <div class="mb-3">
            <div class="mb-3">
                <a class="btn btn-default" href="{{ route('admin.permissions.index') }}">
                    {{ __('Back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ __("ID") }}
                        </th>
                        <td>
                            {{ $zone['id'] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __("Zone Name") }}
                        </th>
                        <td>
                            <span class="btn btn-info btn-xs">{{ $zone['name'] }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mb-3">
                <a class="btn btn-default" href="{{ route('admin.permissions.index') }}">
                    {{ __("Back_to_list") }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

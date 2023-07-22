@extends(getLayout())


@section("meta_tags")
<title>{{ __("Zone List") }}</title>
    <meta name="description" content="Zone List and Manage Zone Details">
    <meta name="keywords" content="zone,zone_list">
@endsection

@section('content')

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('zones.create') }}">
            {{ __("Create Zone") }}
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header border-0">
        {{ __("Zone List") }}
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        {{-- <th>
                            {{ __("#") }}
                        </th> --}}
                        <th>
                            {{ __("Zone Name") }}
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
                    @foreach($zones as $key => $zone)
                        <tr data-entry-id="{{ $zone['id'] }}">
                            <td>

                            </td>
                            {{-- <td>
                                {{ $zone['id'] ?? '' }}
                            </td> --}}
                            <td>
                                {{ $zone['name'] ?? '' }}
                                @if ($zone->cover_whole_world)
                                    <small class="badge bg-warning">{{ __("Worldwide") }}</small>
                                @endif
                            </td>
                            <td>
                                @if ($zone->is_active)
                                    <span class="badge bg-primary">{{ __("Active") }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __("Inactive") }}</span>
                                @endif
                            </td>
                            <td>
                                {{-- <a class="btn btn-xs btn-primary" href="{{ route('zones.show', $zone['id']) }}">
                                    {{ __("View") }}
                                </a> --}}

                                <a class="btn btn-xs btn-info" href="{{ route('zones.edit', $zone['id']) }}">
                                    {{ __("Edit") }}
                                </a>
                                <x-core-delete-dialog :id="$zone['id']"  :action="route('zones.destroy', $zone['id'])"></x-core-delete-dialog>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

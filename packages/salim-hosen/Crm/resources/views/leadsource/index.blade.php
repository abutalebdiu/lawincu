@extends(getLayout())


@section("meta_tags")
<title>{{ __("ULead Sources List") }}</title>
    <meta name="description" content="Lead Sources List and Manage Lead Sources Details">
    <meta name="keywords" content="leadsource,leadsource_list">
@endsection

@section('content')


@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('lead-sources.create') }}">
                {{ __("Create Lead Source") }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        {{ __("Lead Source List") }}
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
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
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leadsources as $key => $source)
                        <tr data-entry-id="{{ $source->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>

                            <td>
                                {{ $source->name ?? '' }}
                            </td>

                            <td>

                                <a class="btn btn-xs btn-primary" href="{{ route('lead-sources.edit', $source->id) }}">
                                    {{ __("edit") }}
                                </a>

                                <x-core-delete-dialog :id="$source->id" :action="route('lead-sources.destroy', $source->id)"></x-core-delete-dialog>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection




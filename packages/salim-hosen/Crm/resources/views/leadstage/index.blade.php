@extends(getLayout())

@section("meta_tags")
<title>{{ __("Lead Stage List") }}</title>
    <meta name="description" content="Lead Stage Created and Manage Lead Stage Details">
    <meta name="keywords" content="leadstage,leadstage_list">
@endsection


@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('lead-stages.create') }}">
                {{ __("Create Lead Stage") }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        {{ __("Stage List") }}
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif

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
                            {{ __("Pipeline") }}
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leadstages as $key => $stage)
                        <tr data-entry-id="{{ $stage->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>

                            <td>
                                {{ $stage->name ?? '' }}
                            </td>

                            <td>
                                {{ $stage->pipeline->name ?? '' }}
                            </td>

                            <td>

                                <a class="btn btn-xs btn-primary" href="{{ route('lead-stages.edit', $stage->id) }}">
                                    {{ __("Edit") }}
                                </a>

                                <x-core-delete-dialog :id="$stage->id" :action="route('lead-stages.destroy', $stage->id)"></x-core-delete-dialog>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection




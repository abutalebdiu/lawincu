@extends(getLayout())


@section("meta_tags")
<title>{{ __("Pipeline List") }}</title>
    <meta name="description" content="Pipeline List and Manage Pipeline Details">
    <meta name="keywords" content="pipeline,pipeline_list">
@endsection

@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('pipelines.create') }}">
                {{ __("Create Pipeline") }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header border-0">
        {{ __("Pipeline List") }}
    </div>

    <div class="card-body p-0">

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
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pipelines as $key => $pipeline)
                        <tr data-entry-id="{{ $pipeline->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>

                            <td>
                                {{ $pipeline->name ?? '' }}
                            </td>

                            <td>

                                <a class="btn btn-xs btn-primary" href="{{ route('pipelines.edit', $pipeline->id) }}">
                                    {{ __("Edit") }}
                                </a>

                                <x-core-delete-dialog :id="$pipeline->id" :action="route('pipelines.destroy', $pipeline->id)"></x-core-delete-dialog>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection




@extends(getLayout())

@section("meta_tags")
<title>{{ __("Folder List") }}</title>
    <meta name="description" content="Lead Sources List and Manage Lead Sources Details">
    <meta name="keywords" content="leadsource,leadsource_list">
@endsection

@section('content')


@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('folders.create') }}">
                {{ __("Create Folder") }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        {{ __("Folder List") }}
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
                    @foreach($folders as $key => $folder)
                        <tr data-entry-id="{{ $folder->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>

                            <td>
                                {{ $folder->name ?? '' }}
                            </td>

                            <td>

                                <a class="btn btn-xs btn-primary" href="{{ route('folders.edit', $folder->id) }}">
                                    {{ __("Edit") }}
                                </a>

                                <x-core-delete-dialog :id="$folder->id" :action="route('folders.destroy', $folder->id)"></x-core-delete-dialog>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection




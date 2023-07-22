@extends(getLayout())

@section("meta_tags")
    <title>{{ __("Tag List") }}</title>
    <meta name="description" content="Tag List and Manage Tag Details">
    <meta name="keywords" content="tag,tag_list">
@endsection

@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('tags.create') }}">
                {{ __("Create Tag") }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header border-0">
        {{ __("Tag List") }}
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
                    @foreach($tags as $key => $tag)
                        <tr data-entry-id="{{ $tag->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>

                            {{-- <td>
                                <img width="50" src="{{ asset($company->logo ? "images/company/logo/$company->logo" : "images/company.png") }}" alt="Company image" class="img-fluid">
                            </td> --}}

                            <td>
                                {{ $tag->name ?? '' }}
                            </td>

                            <td>
                                <a class="btn btn-xs btn-info" href="{{ route('tags.show', $tag->id) }}">
                                    {{ __("View") }}
                                </a>
                                <a class="btn btn-xs btn-primary" href="{{ route('tags.edit', $tag->id) }}">
                                    {{ __("Edit") }}
                                </a>

                                <x-core-delete-dialog :id="$tag->id" :action="route('tags.destroy', $tag->id)"></x-core-delete-dialog>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection




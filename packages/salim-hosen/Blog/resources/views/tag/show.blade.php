@extends(getLayout())


@section("meta_tags")
    <title>{{ __("Tag Details") }}</title>
    <meta name="description" content="Tag List and Manage Tag Details">
    <meta name="keywords" content="tag,tag_details">
@endsection

@section("content")

<section class="content" style="padding-top: 20px">

    <div class="d-flex justify-content-between">
        <a class="btn btn-secondary mb-3" href="{{ route("tags.index") }}">
            {{ __("Back to list") }}
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            {{ __("Tag Details") }}
        </div>

        <div class="card-body">
            <div class="mb-2">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{__('Name')}}
                            </th>
                            <td>
                                {{ $tag->name }}
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
    <a class="btn btn-secondary mb-3" href="{{ route("tags.index") }}">
        {{ __("Back to list") }}
    </a>
</section>


@endsection

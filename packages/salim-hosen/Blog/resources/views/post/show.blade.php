@extends(getLayout())


@section("meta_tags")
    <title>{{ __("Post Details") }}</title>
    <meta name="description" content="Post List and Manage Post Details">
    <meta name="keywords" content="post,post_details">
@endsection

@section("content")

<section class="content" style="padding-top: 20px">

    <div class="d-flex justify-content-between">
        <a class="btn btn-secondary mb-3" href="{{ route("posts.index") }}">
            {{ __("Back to list") }}
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            {{ __("Post Details") }}
        </div>

        <div class="card-body">
            <div class="mb-2">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{__('Title')}}
                            </th>
                            <td>
                                {{ $post->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{__('Image')}}
                            </th>
                            <td>
                                {{ $post->image }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{__('Meta Title')}}
                            </th>
                            <td>
                                {{ $post->meta_title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{__('Meta Keywords')}}
                            </th>
                            <td>
                                {{ $post->meta_keywords }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{__('Meta Description')}}
                            </th>
                            <td>
                                {{ $post->meta_description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{__('Status')}}
                            </th>
                            <td>
                                {{ $post->status }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{__('Content')}}
                            </th>
                            <td>
                                {{ $post->content }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{__('Publish Date')}}
                            </th>
                            <td>
                                {{ $post->publish_date }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{__('Is Activee')}}
                            </th>
                            <td>
                                {{ $post->is_active }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{__('Slug')}}
                            </th>
                            <td>
                                {{ $post->slug }}
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
    <a class="btn btn-secondary mb-3" href="{{ route("posts.index") }}">
        {{ __("Back to list") }}
    </a>
</section>


@endsection

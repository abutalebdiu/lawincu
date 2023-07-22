@extends(getLayout())


@section("meta_tags")
    <title>{{ __("Post List") }}</title>
    <meta name="description" content="Post List and Manage Post Details">
    <meta name="keywords" content="post,post_list">
@endsection

@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('posts.create') }}">
                {{ __("Create Post") }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header border-0">
        {{ __("Post List") }}
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
                            {{ __("Image") }}
                        </th>
                        <th>
                            {{ __("Title") }}
                        </th>

                        <th>
                            {{ __("Publish Date") }}
                        </th>
                        <th>
                            {{ __("Status") }}
                        </th>

                        <th>
                            {{ __("Slug") }}
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $key => $post)
                        <tr data-entry-id="{{ $post->id }}">
                            <td>
                                {{-- @foreach ($post->categories as $category)
                                    <td>{{$category->name}}</td>
                                @endforeach --}}
                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>

                            <td>
                                <img width="80" src="{{ asset($post->image ? "uploads/all/".$post->image->file_name : "images/noimage.png") }}" alt="Post image" class="img-fluid">
                            </td>

                            <td>
                                {{ $post->title ?? '' }}
                            </td>
                            <td>
                                {{ $post->created_at->format("d M Y h:iA") ?? '' }}
                            </td>

                            <td>
                                @if ($post->is_active)
                                    <span class="badge bg-primary">{{ __("Active") }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __("Inactive") }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $post->slug }}
                            </td>

                            <td>
                                <a class="btn btn-xs btn-info" href="{{ route('posts.show', $post->id) }}">
                                    {{ __("View") }}
                                </a>
                                <a class="btn btn-xs btn-primary" href="{{ route('posts.edit', $post->id) }}">
                                    {{ __("Edit") }}
                                </a>

                                <x-core-delete-dialog :id="$post->id" :action="route('posts.destroy', $post->id)"></x-core-delete-dialog>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection




@extends(getLayout())


@section("meta_tags")
    <title>{{ __("Category Details") }}</title>
    <meta name="description" content="Category List and Manage Category Details">
    <meta name="keywords" content="category,category_details">
@endsection

@section("content")

<section class="content" style="padding-top: 20px">

    <div class="d-flex justify-content-between">
        <a class="btn btn-secondary mb-3" href="{{ route("blog-categories.index") }}">
            Back to list
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            Category Details
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
                                {{ $category->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{__('Slug')}}
                            </th>
                            <td>
                                {{ $category->slug }}
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
    <a class="btn btn-secondary mb-3" href="{{ route("blog-categories.index") }}">
        Back to list
    </a>
</section>


@endsection

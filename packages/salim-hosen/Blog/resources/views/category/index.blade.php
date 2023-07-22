@extends(getLayout())

@section("meta_tags")
    <title>{{ __("Category List") }}</title>
    <meta name="description" content="Category List and Manage Category Details">
    <meta name="keywords" content="category,category_listt">
@endsection

@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('blog-categories.create') }}">
                {{ __("Create Category") }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        {{ __("Category List") }}
    </div>

    <div class="card-body">

        <div class="alert alert-info" role="alert">
            It is always recommend that you make category maximum of 3 level deep. <br/>
            <strong>Note:</strong> If you delete one category all Child Category of that will be deleted too
        </div>

        <div class="row">

            @foreach ($categories as $category)
                <div class="col-md-4 mb-3">
                    <ul style="list-style: none">
                        <li class="d-flex align-items-center justify-content-between mb-1">
                            <a href="">
                                <h6>{{ $category->name }}</h6>
                            </a>

                            <span>
                                <a class="btn btn-xs btn-info" href="{{ route('blog-categories.edit', $category->id) }}">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <x-core-delete-dialog label="icon" :id="$category->id" :action="route('blog-categories.destroy', $category->id)"></x-core-delete-dialog>
                            </span>
                        </li>
                        @foreach ($category->childs as $child)
                            <li class="d-flex align-items-center pl-4 mb-1 justify-content-between">
                                <a href="">
                                    {{ $child->name }}
                                </a>

                                <span>
                                    <a class="btn btn-xs btn-info" href="{{ route('blog-categories.edit', $child->id) }}">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <x-core-delete-dialog
                                        label="icon"
                                        :id="$child->id"
                                        :action="route('blog-categories.destroy', $child->id)"
                                    ></x-core-delete-dialog>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

        </div>

        {{-- <div class="table-responsive">
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
                            {{ __("Icon") }}
                        </th>
                        <th>
                            {{ __("Parent Category") }}
                        </th>
                        <th>
                            {{ __("Image") }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $key => $category)
                        <tr data-entry-id="{{ $category->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                <i class="fas fa-{{ $category->icon }}"></i>
                            </td>
                            <td>
                                {{ $category->parent->name ?? '' }}
                            </td>
                            <td>
                                <img width="80" src="{{ asset("images/category/$category->image") }}" class="img-fluid" alt="">
                            </td>
                            <td>

                                <a class="btn btn-xs btn-info" href="{{ route('categories.edit', $category->id) }}">
                                    {{ __("Edit") }}
                                </a>

                                <x-core-delete-dialog :id="$category->id" :action="route('categories.destroy', $category->id)"></x-core-delete-dialog>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}
    </div>
</div>

@endsection


@push('body_scripts')

    @include("core::partials.datatable")

    <script>
        $(function() {

            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-User:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endpush

@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("Page List") }}</title>
    <meta name="description" content="Page LIst and Manage Page Details">
    <meta name="keywords" content="page,page_list">
@endsection

@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('pages.create') }}">
                {{ __("Create Page") }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header border-0">
        {{ __("Page List") }}
    </div>

    <div class="card-body p-0">
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
                            {{ __("URL") }}
                        </th>
                        <th>
                            {{ __("Status") }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $key => $page)
                        <tr data-entry-id="{{ $page->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $page->id ?? '' }}
                            </td>
                            <td>
                                {{ $page->name ?? '' }}
                            </td>
                            <td>
                                /{{ $page->url ?? '' }}
                            </td>
                            <td>
                                @if ($page->is_active)
                                    <span class="badge bg-primary">{{ __("Active") }}</span>
                                @else
                                    <span class="badge bg-dark">{{ __("Inactive") }}</span>
                                @endif
                            </td>
                            <td>
                                {{-- <a class="btn btn-xs btn-info" href="{{ route('page-contents.index', ['page_id' => $page->id]) }}">
                                    {{ __("Contents & SEO") }}
                                </a> --}}

                                    <a class="btn btn-xs btn-primary" href="{{ route('pages.edit', ['page' => $page['id'], 'locale' => app()->getLocale()]) }}">
                                        {{ __("Edit") }}
                                    </a>

                                     {{-- <a class="btn btn-xs btn-info" target="_blank" href="{{ route("page-rows.index", ['page_id' => $page->id]) }}">
                                        {{ __("Page Data") }}
                                    </a> --}}

                                    @if ($page->customization_route && Route::has($page->customization_route))
                                        <a class="btn btn-xs btn-info" target="_blank" href="{{ route($page->customization_route) }}">
                                            {{ __("Customize") }}
                                        </a>
                                    @else
                                        @if ($page->url)
                                            <x-core-delete-dialog :id="$page['id']" :action="route('pages.destroy', $page['id'])"></x-core-delete-dialog>
                                        @endif
                                    @endif

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

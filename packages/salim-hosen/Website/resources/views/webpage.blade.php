
@extends("$theme::layouts.app")

@section("meta_tags")
    <title>{{ $page->title }}</title>
    <meta name="description" content="{{ $page->description }}">
    <meta name="keywords" content="{{ $page->keywords }}">
@endsection

@section('content')

    <div class="container py-5">
        <h1 class="text-center">{{ $page->title }}</h1>
        <div class="card">
            <div class="card-body">
                {!! $page->content ?? "" !!}
            </div>
        </div>
    </div>

@endsection

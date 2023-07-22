@extends('core::layouts.admin')


@section("meta_tags")
    <title>{{ __("Create Menu") }}</title>
    <meta name="description" content="Create Menu and Manage Menu Details">
    <meta name="keywords" content="menu,menu_create">
@endsection

@section('content')

    <div class="card">

        <div class="card-header">
            {{ __('Create Menu') }}
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('menus.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="required" for="name">{{ __('Menu Name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        id="name" value="{{ old('name', '') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="required" for="arabic_name">{{ __('Menu Arabic Name') }}</label>
                    <input class="form-control {{ $errors->has('arabic_name') ? 'is-invalid' : '' }}" type="text"
                        name="arabic_name" id="arabic_name" value="{{ old('arabic_name', '') }}">
                    @error('arabic_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="menu-url" class="form-label">{{ __("URL") }}</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="app-url">{{ config("app.url") }}/</span>
                        <input type="text" class="form-control @error('url') is-invalid @enderror" id="menu-url" name="url" value="{{ old('url') }}">
                        @error('url')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="parent_menu" class="required">{{ __('Parent Menu') }}</label>
                    <select class="form-control {{ $errors->has('parent_menu') ? 'is-invalid' : '' }}" name="parent_menu" id="parent_menu">
                        <option value="">{{ __('Select Parent Menu') }}</option>
                        @foreach ($menus as $menu)
                            <option @if(old('parent_menu') == $menu['id']) selected @endif value="{{ $menu['id'] }}">{{ $menu['name'] }}</option>
                        @endforeach
                    </select>
                    @error('parent_menu')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="">{{ __("Show on Header") }}</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" name="show_on_header" type="checkbox" checked >
                        <label class="form-check-label ms-3" >{{ __("Yes") }}</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="">{{ __("Show on Footer") }}</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" name="show_on_footer" type="checkbox" checked >
                        <label class="form-check-label ms-3" >{{ __("Yes") }}</label>
                    </div>
                </div>



                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">
                        {{ __('Save') }}
                    </button>
                </div>

            </form>

        </div>

    </div>



@endsection

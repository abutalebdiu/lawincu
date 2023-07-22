@extends('core::layouts.admin')

@section("meta_tags")
    <title>{{ __("Language keywords") }}</title>
    <meta name="description" content="Language keywords">
    <meta name="keywords" content="language,keywords">
@endsection


@section('content')



<div class="card">
    <div class="card-header">
        {{ __("Language Keywords") }}
    </div>

    <div class="card-body">
        @if (session('alert-success'))
            <div class="alert alert-success" role="alert">
                {{ session('alert-success') }}
            </div>
        @endif
        <form action="{{ route("language.translation.update", request()->route('locale')) }}" method="POST">
            @csrf
            @method("PUT")
            <div class="table-responsive">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('languages.index') }}">
                        {{ __("Back to List") }}
                    </a>
                </div>
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr>
                            <th>
                                {{ __("Keyword") }}
                            </th>
                            <th>
                                {{ __("Value") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contents as $key => $value)
                            <tr data-entry-id="{{ $key }}">

                                <td>
                                    {{ $key ?? '' }}
                                </td>
                                <td>
                                    <input type="text" name="{{ $key }}" value="{{ $value }}" class="form-control">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary btn-block">{{ __("Update Translation") }}</button>
        </form>
    </div>
</div>

@endsection



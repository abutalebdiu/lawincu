@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("Create Unit") }}</title>
    <meta name="description" content="Create Unit and Manage Unit Details">
    <meta name="keywords" content="unit,unit_create">
@endsection

@section('content')

<div class="card">

    <div class="card-header">
        {{ __("Add to Mailing List") }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("accounts.addto.list") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="mailing_list">{{ __('Mailing List') }}</label>
                <select name="mailing_list" id="mailing_list" class="form-control">
                    <option value="">{{ __("Select Mailing List") }}</option>
                    @foreach ($mailing_lists as $list)
                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                    @endforeach
                </select>
                @error("mailing_list")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <input type="hidden" name="batch_id" value="{{ request('batch_id') }}">
                <button class="btn btn-primary" type="submit">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>

</div>



@endsection

@extends('core::layouts.admin')

@section("meta_tags")
<title>{{ __("Edit Mailing List") }}</title>
    <meta name="description" content="Mailing List Edit">
    <meta name="keywords" content="mailinglist,mailinglist_edit">
@endsection



@section('content')

<div class="card">

    <div class="card-header">
        {{ __('Edit Mailing List') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("mailing-lists.update", $mailingList->id) }}">
            @csrf
            @method("PUT")

            <div class="mb-3">
                <label class="required" for="list_name">{{ __('List Name') }}</label>
                <input class="form-control @error('list_name') is-invalid @enderror" type="list_name" name="list_name" id="list_name" value="{{ old('list_name', $mailingList['name']) }}">
                @error("list_name")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="main_list">{{ __("Main List") }}</label>
                <select name="main_list" id="main_list" class="form-control {{ $errors->has('main_list') ? 'is-invalid' : '' }}">
                    <option value="">{{ __("Select Main List") }}</option>
                    @foreach ($main_lists as $main_list)
                        <option @if($main_list->id == $mailingList->mailing_list_id) selected @endif value="{{ $main_list->id }}">{{ $main_list->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('main_list'))
                    <div class="invalid-feedback">
                        {{ $errors->first('main_list') }}
                    </div>
                @endif
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


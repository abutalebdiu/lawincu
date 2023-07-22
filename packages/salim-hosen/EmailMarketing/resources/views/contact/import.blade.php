@extends('core::layouts.admin')

@section("meta_tags")
<title>{{ __("Import Contact") }}</title>
    <meta name="description" content="Create Employee and Manage Employee Details">
    <meta name="keywords" content="employee,employee_create">
@endsection

@push("head_tags")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
<style>
    .img-flag{
        width: 30px;
    }
</style>
@endpush


@section('content')

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="ml-2 btn btn-success" href="{{ asset('documents/Bulk-Contact-Upload.csv') }}" download="download">
            <i class="fas fa-download"></i>
            <span class="mx-1"></span>
            {{ __("Download Format") }}
        </a>
    </div>
</div>

<div class="card">

    <div class="card-header">
        {{ trans('Create Subscriber') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("contacts.import") }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="required" for="file">{{ __('Upload CSV') }}</label>
                <input type="file" name="file" id="file" class="form-control">
            </div>

            <div class="mb-3">
                <label class="required" for="lists">{{ __('Select Lists') }}</label>
                <select name="lists[]" id="lists" class="select2 form-control @error('lists') is-invalid @enderror" multiple>
                    @foreach ($lists as $list)
                        <option value="{{ $list['id'] }}">{{ $list['name'] }}</option>
                    @endforeach
                </select>
                @error("lists")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
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


@push("body_scripts")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>

    <script>
        $(document).ready(function(){

            $(".select2").select2();

        });
    </script>

@endpush

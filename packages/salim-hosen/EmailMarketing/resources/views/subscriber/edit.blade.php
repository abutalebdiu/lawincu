@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("Edit Subscriber") }}</title>
    <meta name="description" content="Edit Subscriber">
    <meta name="keywords" content="subscriber,subscriber_edit">
@endsection


@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('Edit Menu') }}
    </div>

    <div class="card-body">
        <currency-edit-component
            currency="{{ json_encode($currency) }}"
            redirect_to="{{ route('menus.index') }}">
        </currency-edit-component>
    </div>
</div>



@endsection

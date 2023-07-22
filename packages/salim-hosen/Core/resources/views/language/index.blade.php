@extends('core::layouts.admin')


@section("meta_tags")
    <title>{{ __("Language List") }}</title>
    <meta name="description" content="Language List and Manage Language Details">
    <meta name="keywords" content="language,language_list">
@endsection


@section('content')

{{-- <div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('languages.create') }}">
            {{ __("Create Language") }}
        </a>
    </div>
</div> --}}

<div class="card">
    <div class="card-header border-0">
        {{ __("Language List") }}
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>

                        <th>
                            {{ __("#") }}
                        </th>
                        <th>
                            {{ __("Name") }}
                        </th>
                        <th>
                            {{ __("Code") }}
                        </th>
                        <th>
                            {{ __("Direction") }}
                        </th>
                        <th>
                            {{ __("Status") }}
                        </th>
                        <th>
                            {{ __("Action") }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($languages as $key => $language)
                        <tr data-entry-id="{{ $language->id }}">

                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ $language->name ?? '' }}

                            </td>
                            <td>
                                {{ $language->code ?? '' }}
                            </td>
                            <td>
                                {{ strtoupper($language->direction) ?? '' }}
                            </td>
                            <td>
                                @if( $language->is_active )
                                    <span class="badge badge-primary">{{ __("active") }}</span>
                                @else
                                    <span class="badge badge-secondary">{{ __("disabled") }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($language->code != config('settings.language'))
                                    <a class="btn btn-xs btn-info" href="{{ route('language.default', $language->id) }}">
                                        {{ __("Make Default") }}
                                    </a>
                                @endif

                                @if ($language->code != config('settings.language'))
                                    <a class="btn btn-xs btn-primary" href="{{ route('languages.edit', $language->id) }}">
                                        {{ __("Edit") }}
                                    </a>
                                    <x-core-delete-dialog :id="$language->id"  :action="route('languages.destroy', $language->id)"></x-core-delete-dialog>
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




@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("Template List") }}</title>
    <meta name="description" content="Template List and Manage Template Details">
    <meta name="keywords" content="template,template_list">
@endsection

@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('email-templates.create') }}">
                {{ __('Create Template') }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        {{ __("Template List") }}
    </div>

    <div class="card-body">
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
                            {{ __("Template Name") }}
                        </th>

                        <th>
                            {{ __("Active") }}
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($templates as $template)
                        <tr data-entry-id="{{ $template['id'] }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>

                            <td>
                                {{ $template->name ?? '' }}
                            </td>

                            <td>
                                @if ($template->is_active)
                                    <span class="badge bg-success">{{ __("Active") }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __("Inactive") }}</span>
                                @endif

                            </td>

                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('email-templates.edit', $template['id']) }}">
                                    {{ __('Edit') }}
                                </a>
                                <x-core-delete-dialog :id="$template['id']" :action="route('email-templates.destroy', $template['id'])"></x-core-delete-dialog>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection


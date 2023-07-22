@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("Subscriber List") }}</title>
    <meta name="description" content="Subscriber  List and Manage Subscriber Details">
    <meta name="keywords" content="subscriber,subscriber_list">
@endsection

@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('subscribers.create') }}">
                {{ __('Create Subscriber') }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header border-0">
        {{ __("Subscriber List") }}
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
                            {{ __("Email") }}
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subscribers as $subscriber)
                        <tr data-entry-id="{{ $subscriber['id'] }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>

                            <td>
                                {{ $subscriber['email'] ?? '' }}
                            </td>

                            <td>
                                {{-- <a class="btn btn-xs btn-primary" href="{{ route('subscribers.edit', $subscriber['id']) }}">
                                    {{ __('Edit') }}
                                </a> --}}
                                <x-core-delete-dialog :id="$subscriber['id']" :action="route('subscribers.destroy', $subscriber['id'])"></x-core-delete-dialog>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection



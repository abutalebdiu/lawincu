@extends('core::layouts.admin')

@section("title", "Permission List")

@section("meta_tags")
    <meta name="description" content="Permission List and Manage Permission List Details">
    <meta name="keywords" content="permission,permission_list">
@endsection

@section('content')

    @forelse ($notifications as $notification)
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route("notifications.show", $notification['id']) }}">
                            <div class="d-flex align-items-center">
                                <div>
                                    <i class="fas fa-envelope h4 mb-0 text-danger"></i>
                                    <span class="mx-2"></span>
                                </div>
                                <div>
                                    <div class="text-truncate font-weight-bold">{{ $notification['title'] }}</div>
                                    <div class="small text-muted text-truncate">{{ $notification['created_at'] }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <p>{{ __("No Notification Found") }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforelse

@endsection


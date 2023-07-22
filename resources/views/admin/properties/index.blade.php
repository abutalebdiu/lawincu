@extends(getLayout())
@section('meta_tags')
    <title>{{ __('Property List') }}</title>
    <meta name="description" content="Property List and Manage Property Details">
    <meta name="keywords" content="Property,Property_list">
@endsection
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.property.create') }}">
                {{ __('Create Property') }}
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-0">
            {{ __('Property List') }}
        </div>

        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID.</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Title (Arabic)</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($properties as $property)
                            <tr>
                                <td>{{ $property->id }}</td>
                                <td>
                                    <a href="{{ route('admin.property.show', $property) }}">
                                        <img class="border" width="60" src="{{ $property->urlOf('image') }}">
                                    </a>
                                </td>
                                <td><a href="{{ route('admin.property.show', $property) }}">{{ $property->title }}</a></td>
                                <td><a href="{{ route('admin.property.show', $property) }}">{{ $property->title_ar }}</a></td>
                                <td>{{ optional($property->type)->name }}</td>

                                <td>
                                    @if ($property->status == "Active")
                                        <span class="badge bg-success">Active</span>
                                    @endif
                                    @if ($property->status == "Pending")
                                        <span class="badge bg-danger">Pending</span>
                                    @endif
                                    @if ($property->status == 3)
                                        <span class="badge bg-info">Draft</span>
                                    @endif
                                </td>
                                <td>{{ $property->created_at }} </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('admin.property.edit', $property) }}">
                                                <i data-feather="edit-2" class="me-50"></i>
                                                <span>Edit</span>
                                            </a>
                                            <form action="{{ route('admin.property.destroy', $property->slug) }}"
                                                method="post">
                                                @csrf
                                                @method('Delete')
                                                <button type="submit"  class="btn btn-sm hide-arrow">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-1">
                {{ $properties->links() }}
            </div>
        </div>
    </div>
@endsection

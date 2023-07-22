@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("Menu List") }}</title>
    <meta name="description" content="Menu List and Manage Menu Details">
    <meta name="keywords" content="menu,menu_list">
@endsection

@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('menus.create') }}">
                {{ __("Create Menu") }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header border-0">
        {{ __("Menu List") }}
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
                            {{ __("Name") }}
                        </th>
                        <th>
                            {{ __("URL") }}
                        </th>
                        <th>
                            {{ __("Status") }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $key => $menu)
                        <tr data-entry-id="{{ $menu->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $menu->id ?? '' }}
                            </td>
                            <td>
                                {{ $menu->name ?? '' }}
                            </td>
                            <td>
                                /{{ $menu->url }}
                            </td>
                            <td>
                                @if ($menu->is_active)
                                    <span class="badge bg-primary">{{ __("Active") }}</span>
                                @else
                                    <span class="badge bg-primary">{{ __("Inactive") }}</span>
                                @endif
                            </td>
                            <td>

                                    <a class="btn btn-xs btn-info" href="{{ route('menus.edit', $menu->id) }}">
                                        {{ __("Edit") }}
                                    </a>

                                    <x-core-delete-dialog :id="$menu->id" :action="route('menus.destroy', $menu->id)"></x-core-delete-dialog>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

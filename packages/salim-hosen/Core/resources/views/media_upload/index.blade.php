@extends('core::layouts.admin')

@section("title", "Permission List")

@section("meta_tags")
    <meta name="description" content="Permission List and Manage Permission List Details">
    <meta name="keywords" content="permission,permission_list">
@endsection

@section('content')

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('media-library.create') }}">
            {{ __('Upload New File') }}
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-0 h6">{{__('All files')}}</h5>
            <form action="" class="d-flex">
                <input type="text" class="form-control form-control-xs" name="q" placeholder="{{ __('Search your files') }}" value="{{ request('search') }}" value="{{ request('q') }}">
                <div class="mx-1"></div>
                <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
            </form>
        </div>
    </div>
    <div class="card-body">
    	<div class="row gutters-5">
    		@foreach($uploads as $key => $file)
                <div class="col-2 px-1 mb-2">
                    <div class="border p-2">
                        <div class="dropdown-file" >
    						<a class="dropdown-link d-flex justify-content-end" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    							<i class="fas fa-ellipsis-v"></i>
    						</a>
    						<div class="dropdown-menu dropdown-menu-end">
    							<a href="{{ asset("uploads/all/".$file->file_name) }}" target="_blank" download="{{ $file->file_name }}" class="dropdown-item">
    								<i class="fas fa-download mr-2"></i>
    								<span>{{ __('Download') }}</span>
    							</a>
    							<a href="javascript:void(0)" class="dropdown-item" onclick="copyUrl(this)" data-url="{{ asset("uploads/all/".$file->file_name) }}">
    								<i class="fas fa-clipboard mr-2"></i>
    								<span>{{ __('Copy Link') }}</span>
    							</a>
    							<a href="javascript:void(0)" class="dropdown-item confirm-alert"  data-bs-toggle="modal" data-bs-target="#id_{{ $file->id }}">
    								<i class="fas fa-trash mr-2"></i>
    								<span>{{ __('Delete') }}</span>
    							</a>
    						</div>
                            <x-core-confirm-dialog :id="$file->id" :action="route('media-library.destroy', $file->id)"></x-core-confirm-dialog>
    					</div>
                        <div>
                            @if($file->file_type == 'image')
                                <img src="{{ asset("uploads/all/".$file->file_name) }}" class="img-fluid">
                            @elseif($file->file_type == 'video')
                                <i class="las la-file-video"></i>
                            @else
                                <i class="las la-file"></i>
                            @endif
                            <div>
                                <h6 class="d-flex">
                                    <span class="text-truncate title">{{ $file->original_name }}</span>
                                    {{-- <span class="ext">.{{ $file->extension }}</span> --}}
                                </h6>
                                <p>{{ formatBytes($file->file_size) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
    		@endforeach
    	</div>
		<div class="aiz-pagination mt-3">
			{{ $uploads->appends(request()->input())->links() }}
		</div>
    </div>
</div>

@endsection


@push('body_scripts')
	<script type="text/javascript">

		function copyUrl(e) {
			var url = $(e).data('url');
			var $temp = $("<input>");
		    $("body").append($temp);
		    $temp.val(url).select();
		    try {
			    document.execCommand("copy");
                toastr.success("{{ __("Copied Successfully") }}")
			} catch (err) {
			    toastr.error("{{ __("Fail to Copy") }}")
			}
		    $temp.remove();
		}

	</script>
@endpush

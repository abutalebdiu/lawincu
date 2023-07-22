@extends('core::layouts.admin')

@section("title", "Create Permission")

@section("meta_tags")
    <meta name="description" content="Create Permission and Manage Permission Details">
    <meta name="keywords" content="permission,permission_create">
@endsection

@push("head_tags")
    <link rel="stylesheet" href="{{ asset("css/uppy.min.css") }}">
@endpush

@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('media-library.index') }}">
            {{ __('Back to Uploaded Files') }}
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{ __('Drag & drop your files')}}</h5>
    </div>
    <div class="card-body">
    	<div id="upload-files" class="h-420px" style="min-height: 65vh">

    	</div>
    </div>
</div>

@endsection


@push('body_scripts')

    <script src="{{ asset("js/uppy.min.js") }}"></script>

	<script type="text/javascript">
		$(document).ready(function() {
            if ($("#upload-files").length > 0) {
                var uppy = Uppy.Core({
                    autoProceed: true,
                });
                uppy.use(Uppy.Dashboard, {
                    target: "#upload-files",
                    inline: true,
                    showLinkToFileUploadResult: false,
                    showProgressDetails: true,
                    hideCancelButton: true,
                    hidePauseResumeButton: true,
                    hideUploadButton: true,
                    proudlyDisplayPoweredByUppy: false,
                    locale: {
                        strings: {
                            addMoreFiles: "Add more files",
                            addingMoreFiles: 'Adding more files',
                            dropPaste: 'Drop files here, paste or' +' %{browse}',
                            browse: 'Browse',
                            uploadComplete: "Upload Complete",
                            uploadPaused: "Upload Paused",
                            resumeUpload: "Resume Upload",
                            pauseUpload: "Pause Upload",
                            retryUpload: "Retry Upload",
                            cancelUpload: "Cancel Upload",
                            xFilesSelected: {
                                0: '%{smart_count} '+ "File Selected",
                                1: '%{smart_count} '+ "Files Selected"
                            },
                            uploadingXFiles: {
                                0: "Uploading"+' %{smart_count} '+ "File",
                                1: "Uploading"+' %{smart_count} '+ "Files"
                            },
                            processingXFiles: {
                                0: "Processing" +' %{smart_count} '+ "File",
                                1: "Processing" +' %{smart_count} '+ "Files"
                            },
                            uploading: "Uploading",
                            complete: "Complete",
                        }
                    }
                });
                uppy.use(Uppy.XHRUpload, {
                    endpoint: "{{ route('media-library.store') }}",
                    fieldName: "chosen_file",
                    formData: true,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                });
                uppy.on("upload-success", function () {
                    // alert("Upload Success");
                });
            }
		});
	</script>
@endpush

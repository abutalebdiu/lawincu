@push("head_tags")
    <link rel="stylesheet" href="{{ asset("css/uppy.min.css") }}">
    <style>

        .uppy-Dashboard-inner, .uppy-Root {
            width: 100% !important;
            height: 100% !important;
        }

        .media-container{
            display: flex;
            flex-wrap: wrap;
        }

        .media-object{
            width: 200px;
        }

    </style>
@endpush

<div class="modal fade" id="fileUploaderModal" data-backdrop="static" role="dialog" aria-hidden="true" >
	<div class="modal-dialog modal-fullscreen" role="document">
		<div class="modal-content">
			<div class="modal-header pb-0 bg-light">
				<div class="uppy-modal-nav">
					<ul class="nav nav-tabs border-0 media-upload-tab">
                        <li class="nav-item">
							<a class="nav-link active font-weight-medium text-dark" @click="selected_media_tab=0" data-bs-toggle="tab" href="#upload-new">{{ __('Upload Files') }}</a>
						</li>
						<li class="nav-item">
							<a class="nav-link font-weight-medium text-dark" @click.prevent="mediaLibrary" data-bs-toggle="tab" href="#select-file">{{ __('Media Library') }}</a>
						</li>
					</ul>
				</div>
				<i role="button" class="fas fa-times close"   aria-label="Close" data-bs-dismiss="modal"></i>
			</div>
			<div class="modal-body">
				<div class="tab-content h-100">
                    <div class="tab-pane h-100 active" id="upload-new">
						<div id="upload-files" class="h-100">
						</div>
					</div>
					<div class="tab-pane" id="select-file">
						<div class="pt-1 pb-3 border-bottom mb-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <!-- Input -->
                                    {{-- <select class="form-select">
                                        <option value="">{{ __("Filter By") }}</option>
                                        <option value="images">{{ __('Images') }}</option>
                                        <option value="videos">{{ __('Videos') }}</option>
                                        <option value="documents">{{ __('Documents') }}</option>
                                    </select> --}}
                                    <!-- End Input -->
                                    <h6>{{ __("Select Files") }}</h6>
                                </div>
                                <div>
                                    <input type="text" @change="mediaLibrary" class="form-control form-control-xs" name="uploader-search" placeholder="{{ __('Search your files') }}">
                                    <i class="search-icon d-md-none"><span></span></i>
                                </div>
                            </div>
						</div>
						<div class="clearfix c-scrollbar-light" id="media-files">
                            <div class="text-center" v-if="media_loader">
                                <i class="fas fa-spinner fa-spin" style="font-size: 30px"></i>
                            </div>
                            <div class="media-container" v-else>
                                <div class="media-object mb-2 px-1 h-100" v-for="media in media_library.data" :key="media.id">
                                    <div role="button" class="border p-2" :class="{'media-selected': isMediaSelected(media.id)}" @click="() => toggleSelectedFiles(media)">
                                        <img :src="media.url" alt="" class="img-fluid h-100">
                                        <p class="text-truncate title">@{{ media.original_name }}</p>
                                        <p>@{{ media.file_size }}</p>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between bg-light" v-if="selected_media_tab == 1">
				<div class="flex-grow-1 overflow-hidden d-flex">
					<div class="">
						<div class="uploader-selected">@{{ files[selected_file_field].data.length }} {{ __(' File selected') }}</div>
						<button type="button" @click="files[selected_file_field].data=[]" class="btn-link btn btn-sm p-0 uploader-selected-clear">{{ __('Clear') }}</button>
					</div>
					<div class="mb-0 ms-3">
						<button type="button" class="btn btn-sm btn-primary"  @click.prevent="mediaPrevPage">{{ __('Prev') }}</button>
						<button type="button" class="btn btn-sm btn-primary"  @click.prevent="mediaNextPage">{{ __('Next') }}</button>
					</div>
				</div>
				<button @click="mediaUploadDone" type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">{{ __('Done') }}</button>
			</div>
		</div>
	</div>
</div>

@push("body_scripts")
    <script>
        vdata = {
            ...vdata,
            media_loader: true,
            selected_media_tab: 0,
            media_per_page: 27,
            media_page: 1,
            media_library: {}
        }

        vmethods = {
            ...vmethods,
            async mediaLibrary(e){
                this.selected_media_tab = 1;
                try {
                    const response = await axios.get("{{ route('media-library.index') }}"+`?page=${this.media_page}&per_page=${this.media_per_page}&q=${e.target.value ?? ""}`);
                    this.media_library = response.data;
                    this.media_loader = false;
                } catch (err) {
                    console.log(err);
                    // this.toast("Something Wen't Wrong!", "error");
                }
            },
            async mediaPrevPage(e){
                if(this.media_page==1) return false;
                this.media_page--;
                this.mediaLibrary(e);
            },
            async mediaNextPage(e){
                if(this.media_library.meta.last_page == this.media_page) return false;
                this.media_page++;
                this.mediaLibrary(e);
            },
            toggleSelectedFiles(media){

                const media_files = this.files[this.selected_file_field].data;
                const is_multiple = this.files[this.selected_file_field].multiple;

                if(is_multiple == false){
                    this.files[this.selected_file_field].data = [{...media}];
                    return false;
                }

                const filtered = media_files.filter(med => med.id == media.id);

                if(filtered.length > 0){
                    const newSelectedFiles = media_files.filter(med => med.id != media.id);
                    this.files[this.selected_file_field].data = newSelectedFiles;
                }else{
                    this.files[this.selected_file_field].data.push(media);
                }
            },
            isMediaSelected(media_id){
                const media_files = this.files[this.selected_file_field].data;
                const filtered = media_files.filter(med => med.id == media_id);
                return filtered.length > 0;
            }
        }

        vcreated = {
            ...vcreated,
            // function key: function(){}
        }

        vmounted = {
            ...vmounted,
            // function key: function(){}
        }
    </script>

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

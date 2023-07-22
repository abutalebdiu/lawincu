<div class="modal fade" id="bulkImportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{ __("Import") }}</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class='col-md-12'>

                        <form class="form-horizontal" method="POST" action="{{ route("bulk.import.parse", ['model' => $model]) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="view" value="{{ $view }}">
                            <input type="hidden" name="redirect_url" value="{{ $redirect_url }}">
                            <input type="hidden" name="post_route" value="{{ $post_route }}">
                            <input type="hidden" name="additional_data" value="{{ $additional_data }}">

                            <div class="mb-3{{ $errors->has('file') ? ' has-error' : '' }}">
                                <label for="file" class="col-md-4 control-label">{{ __("File to Import") }}</label>

                                <div class="col-md-6">
                                    <input id="file" type="file" class="form-control-file" name="file" required>
                                    @if($errors->has('file'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="header" checked> {{ __("File Contains Header") }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __("Import") }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

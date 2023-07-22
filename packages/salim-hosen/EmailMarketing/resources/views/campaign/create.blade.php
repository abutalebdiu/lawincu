@extends('core::layouts.admin')


@section('meta_tags')
    <title>{{ __("Create Campaign") }}</title>
    <meta name="description" content="Campaing Create and Manage Campaing Details">
    <meta name="keywords" content="campaing,campaing_create">
@endsection

@push('head_tags')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

    @if ($errors->count() > 0)
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card position-relative">
        <div v-if="loading" class="loader position-absolute" style="width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        z-index: 99999;
        padding-top: 100px;
        background: rgba(255,255,255,0.7);">
            <div>
                <i class="fas fa-spinner fa-spin" style="font-size: 30px"></i>
            </div>
        </div>

        <div class="card-header">
            {{ __('Create Campaign') }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('campaigns.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="required" for="name">{{ __('Campaign Name') }}</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name"
                        value="{{ old('name', '') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="required" for="sender">{{ __('Select Sender') }}</label>
                    <select name="sender" id="sender" class="form-control @error('sender') is-invalid @enderror"
                        value="{{ old('sender', '') }}">
                        @foreach ($senders as $sender)
                            @if (in_array($sender['email'], $sb_senders))
                                <option value="{{ $sender['id'] }}">{{ $sender['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('sender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="required" for="subject">{{ __('Subject') }}</label>
                    <input class="form-control @error('subject') is-invalid @enderror" type="text" name="subject"
                        id="subject" value="{{ old('subject', '') }}">
                    @error('subject')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="required" for="template">{{ __('Template') }}</label>
                    <select @change.prevent="fetchTemplate" name="template" id="template"
                        class="form-control @error('template') is-invalid @enderror" value="{{ old('template', '') }}">
                        <option value="">{{ __('Select Template') }}</option>
                        @foreach ($templates as $template)
                            <option value="{{ $template['id'] }}">{{ $template['name'] }}</option>
                        @endforeach
                    </select>
                    @error('template')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="required" for="content">{{ __('Content') }}</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content"
                        name="content">{{ old('content', '') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="required" for="lists">{{ __('Send to List') }}</label>
                    <select name="lists[]" id="lists" class="select2 form-control @error('lists') is-invalid @enderror"
                        multiple>
                        @foreach ($lists as $list)
                            <option @if (in_array($list['id'], old('lists') ?? [])) selected @endif value="{{ $list['id'] }}">
                                {{ $list['name'] }}</option>
                        @endforeach
                    </select>
                    @error('lists')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- <div class="mb-3">
                <label for="schedule_at">{{ __('Schedule At') }}</label>
                <input class="form-control @error('schedule_at') is-invalid @enderror" type="datetime-local" name="schedule_at" id="schedule_at" value="{{ old('schedule_at', '') }}">
                @error('schedule_at')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div> --}}


                <div class="mb-3">
                    <input type="hidden" name="timezone" id="timezone">
                    {{-- <button class="btn btn-info" type="submit" name="submit" value="schedule">
                    <i class="fas fa-clock"></i>
                    {{ __('Schedule') }}
                </button> --}}
                    <button class="btn btn-primary" type="submit" name="submit" value="sendnow">
                        <i class="fas fa-paper-plane"></i>
                        {{ __('Send Now') }}
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection


@push('body_scripts')
    <script>
        vdata = {
            ...vdata,
            loading: false,
            templates: @json($templates)
        }

        vmethods = {
            ...vmethods,
            async fetchTemplate(e) {

                try {
                    this.loading = true;
                    // const res = await axios.get(`https://api.sendinblue.com/v3/smtp/templates/${e.target.value}`, {headers: {"api-key": "{{ env('SENDINBLUE_API_KEY') }}"}});
                    const filtered = this.templates.filter(row => row.id == e.target.value);
                    tinymce.get("content").setContent(filtered[0].content);
                    this.loading = false;

                } catch (e) {

                    toastr.error("Something Wen't Wrong!");
                    this.loading = false;

                }

            }
        }

        vcreated = {
            ...vcreated
            // function key: function(){}
        }

        vmounted = {
            ...vmounted,
            // function key: function(){}
        }
    </script>


<script src="https://cdn.tiny.cloud/1/uk57kx8225bu90dgs5yav45m4xtqeohx6okmiaiiukd893pr/tinymce/5/tinymce.min.js"
referrerpolicy="origin"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script>
tinymce.init({
    language: 'en',
    selector: '#content',
    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    toolbar_mode: 'floating',
    toolbar: [
        'ltr rtl | acelletags | undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify',
        'outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl'
    ],
    plugins: 'fullpage print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    imagetools_cors_hosts: ['picsum.photos'],
    toolbar_location: 'top',
    menubar: true,
    statusbar: false,
    toolbar_sticky: true,
    height: "600"
});
</script>



<script>
$(document).ready(function() {
    $(".select2").select2();
});
</script>

<script>
$(document).ready(function() {
    const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    $("#timezone").val(timezone);
});
</script>

@endpush


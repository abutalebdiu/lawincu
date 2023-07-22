@extends('core::layouts.admin')


@section('meta_tags')
    <title>{{ __("Create Mail Message") }}</title>
    <meta name="description" content="Create Mailmessage and Manage Mailmessage Details">
    <meta name="keywords" content="mailmessage,mailmessage_create">
@endsection

@push('head_tags')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/tags-input.css') }}">
@endpush

@section('content')

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
            {{ __('Send Email') }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('mail-message.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="required" for="sender">{{ __('Select Sender') }}</label>
                    <select name="sender" id="sender" class="form-control @error('sender') is-invalid @enderror"
                        @change.prevent="filterSender">
                        <option>{{ __('Select Sender') }}</option>
                        @foreach ($senders as $sender)
                            <option value="{{ $sender['id'] }}">{{ $sender['name'] }}</option>
                        @endforeach
                    </select>
                    @error('sender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <label class="required" for="to">{{ __('To') }}</label>
                        <div class="d-flex">
                            <div class="text text-primary">
                                <span @click.prevent="cc=!cc" role="button">CC</span>
                                <span v-if="cc" class="text-danger">x</span>
                            </div>
                            <div class="mx-1"></div>
                            <div role="button" class="text text-primary">
                                <span @click.prevent="bcc=!bcc" role="button">BCC</span>
                                <span v-if="bcc" class="text-danger">x</span>
                            </div>
                        </div>
                    </div>
                    <input class="form-control tags-input @error('to') is-invalid @enderror" type="text" name="to" id="to"
                        value="{{ old('to', request('email')) }}">
                    @error('to')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3" v-show="cc">
                    <label for="cc">{{ __('CC') }}</label>
                    <input class="form-control tags-input @error('cc') is-invalid @enderror" type="text" name="cc" id="cc">
                    @error('cc')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3" v-show="bcc">
                    <label for="bcc">{{ __('BCC') }}</label>
                    <input class="form-control tags-input @error('bcc') is-invalid @enderror" type="text" name="bcc"
                        id="bcc">
                    @error('bcc')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="required" for="subject">{{ __('Subject') }}</label>
                    <input class="form-control @error('subject') is-invalid @enderror" type="text" name="subject"
                        id="subject">
                    @error('subject')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="required" for="template">{{ __('Template (optional)') }}</label>
                    <select @change.prevent="fetchTemplate" name="template" id="template"
                        class="form-control @error('template') is-invalid @enderror">
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
                    <input type="hidden" name="timezone" id="timezone">
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
            cc: false,
            bcc: false
        }

        vmethods = {
            ...vmethods,
            async fetchTemplate(e) {

                try {
                    this.loading = true;
                    const res = await axios.get(`https://api.sendinblue.com/v3/smtp/templates/${e.target.value}`, {
                        headers: {
                            "api-key": "{{ env('SENDINBLUE_API_KEY') }}"
                        }
                    });
                    tinymce.get("content").setContent(res.data.htmlContent);
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

<script src="{{ asset('js/tags-input.js') }}"></script>
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


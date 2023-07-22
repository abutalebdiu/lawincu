@component('mail::message')
# Thanks for your Query

{{ request()->reply_message }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

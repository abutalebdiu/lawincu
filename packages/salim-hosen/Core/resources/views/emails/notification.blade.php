@component('mail::message')
Dear {{ $user->name ?? "" }},

You have a Notification.<br/>
{{ $notification->title ?? "" }} <br/>
{{ $notification->description ?? "" }}<br/>
@component('mail::button', ['url' => $notification->url ?? ""])
    View Details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

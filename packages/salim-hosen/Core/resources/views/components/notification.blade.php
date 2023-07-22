<li class="nav-item dropdown nav-menu" v-cloak>
    <a class="nav-link px-4 position-relative" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="far fa-bell"></i>
        <span class="position-absolute bottom-10 start-95 translate-middle badge rounded-pill bg-danger notification-counter">
            @{{ notifications.length }}
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="dropdownMenuLink" style="min-width: 250px;">
        <div class="dropdown-header bg-light">
            <strong>{{ __("You have") }} @{{ notifications.length }} {{ __("Notifications") }}</strong>
        </div>
        <a v-for="notification in notifications" :key="notification.id" class="dropdown-item"
            :href="`/notifications/${notification.id}`">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-envelope h4 mb-0 text-danger"></i>
                    <span class="mx-2"></span>
                </div>
                <div>
                    <div class="text-truncate font-weight-bold">@{{ notification.title }}</div>
                    <div class="small text-muted text-truncate">@{{ notification.created_at }}</div>
                </div>
            </div>
        </a>
        <a href="{{ route('notifications.index') }}"
            class="dropdown-item text-center border-top"><strong>{{ __('View all Notifications') }}</strong></a>
    </div>
</li>

@push('body_scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        vdata = {
            ...vdata,
            notifications: @json($notifications),
        }


        vmethods = {
            ...vmethods,
        }

        vcreated = {
            ...vcreated
        }

        vmounted = {
            ...vmounted,
            userNotification: function() {
                Echo.private("user-notification.{{ Auth::user()->id }}")
                    .listen('UserNotification', (e) => {
                        vdata.notifications.push(e.notification);
                    });
            }
            // function key: function(){}
        }
    </script>
@endpush

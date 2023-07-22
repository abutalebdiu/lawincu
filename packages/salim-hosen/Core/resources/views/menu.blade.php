
<li class="c-sidebar-nav-item">
    <a href="{{ route("home") }}" class="c-sidebar-nav-link text-light" >
        <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

        </i>
        {{ __("Dashboard") }}
    </a>
</li>
<li class="c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="fa-fw fas fa-users c-sidebar-nav-icon">

        </i>
        {{ __("User Management") }}
    </a>
    <ul class="c-sidebar-nav-dropdown-items">

            <li class="c-sidebar-nav-item">
                <a href="{{ route("permissions.index") }}" class="c-sidebar-nav-link">
                    <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                    </i>
                    {{ __("Permissions") }}
                </a>
            </li>

            <li class="c-sidebar-nav-item">
                <a href="{{ route("roles.index") }}" class="c-sidebar-nav-link ">
                    <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                    </i>
                    {{ __("Roles") }}
                </a>
            </li>

            <li class="c-sidebar-nav-item">
                <a href="{{ route("subroles.index") }}" class="c-sidebar-nav-link ">
                    <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                    </i>
                    {{ __("Sub Roles") }}
                </a>
            </li>

            <li class="c-sidebar-nav-item">
                <a href="{{ route("users.index") }}" class="c-sidebar-nav-link">
                    <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                    </i>
                    {{ __("All Users") }}
                </a>
            </li>

    </ul>
</li>

<li class="c-sidebar-nav-item">
    <a href="{{ route("companies.index") }}" class="c-sidebar-nav-link text-light" >
        <i class="c-sidebar-nav-icon fas fa-fw fa-building">

        </i>
        {{ __("Companies") }}
    </a>
</li>

<li class="c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="fa-fw fas fa-address-book c-sidebar-nav-icon">

        </i>
        {{ __("Contacts & Accounts") }}
    </a>
    <ul class="c-sidebar-nav-dropdown-items">

        <li class="c-sidebar-nav-item">
            <a href="{{ route("contacts.index") }}" class="c-sidebar-nav-link">
                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                </i>
                {{ __("Contacts") }}
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="{{ route("accounts.index") }}" class="c-sidebar-nav-link ">
                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                </i>
                {{ __("Accounts") }}
            </a>
        </li>
    </ul>
</li>


<li class="c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="fa-fw fas fa-map-marker-alt c-sidebar-nav-icon">

        </i>
        {{ __("Locations") }}
    </a>
    <ul class="c-sidebar-nav-dropdown-items">

            <li class="c-sidebar-nav-item">
                <a href="{{ route('countries.index') }}" class="c-sidebar-nav-link">
                    <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                    </i>
                    {{ __("Countries") }}
                </a>
            </li>

            <li class="c-sidebar-nav-item">
                <a href="{{ route('states.index') }}" class="c-sidebar-nav-link ">
                    <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                    </i>
                    {{ __("States") }}
                </a>
            </li>

            <li class="c-sidebar-nav-item">
                <a href="{{ route('cities.index') }}" class="c-sidebar-nav-link ">
                    <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                    </i>
                    {{ __("Cities") }}
                </a>
            </li>

        {{-- <li class="c-sidebar-nav-item">
            <a href="" class="c-sidebar-nav-link ">
                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                </i>
                Delivery Locations
            </a>
        </li> --}}
    </ul>
</li>


<li class="c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

        </i>
        {{ __("Settings") }}
    </a>
    <ul class="c-sidebar-nav-dropdown-items">

            <li class="c-sidebar-nav-item">
                <a href="{{ route('settings.general') }}" class="c-sidebar-nav-link text-light" >
                    <i class="c-sidebar-nav-icon far fa-circle ">

                    </i>
                    {{ __("General Settings") }}
                </a>
            </li>

            <li class="c-sidebar-nav-item">
                <a href="{{ route('currencies.index') }}" class="c-sidebar-nav-link text-light" >
                    <i class="c-sidebar-nav-icon far fa-circle">

                    </i>
                    {{ __("Currencies") }}
                </a>
            </li>


            <li class="c-sidebar-nav-item">
                <a href="{{ route('languages.index') }}" class="c-sidebar-nav-link text-light" >
                    <i class="c-sidebar-nav-icon far fa-circle">

                    </i>
                    {{ __("Languages") }}
                </a>
            </li>
    </ul>
</li>


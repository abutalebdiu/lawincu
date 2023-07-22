<div class="btn-group language-dropdown">
    <span role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img width="20" src="{{ asset("images/country/".$default_language->country->flag) }}" alt="" class="img-fluid">
        <span class="mx-1">{{ $default_language->name }}</span>
        <i class="fas fa-angle-down"></i>
    </span>
    <div class="dropdown-menu dropdown-menu-end">
        @foreach ($languages as $language)
            @if ($host != $url)
                <a class="dropdown-item" href="{{ str_replace($host."/".app()->getLocale(), $host."/".$language->code , $url) }}">{{ $language->name }}</a>
            @else
                <a class="dropdown-item" href="{{ $host."/".$language->code }}">{{ $language->name }}</a>
            @endif
        @endforeach
    </div>
</div>

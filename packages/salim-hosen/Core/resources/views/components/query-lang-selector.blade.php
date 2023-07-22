

<li class="nav-item dropdown nav-menu">
    <a class="nav-link px-0" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
      aria-expanded="false">
      <img width="30" src="{{ asset("uploads/flag/".$default_language->country->flag) }}" alt="" class="img-fluid">
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
        @foreach ($languages as $language)
              <a class="dropdown-item" href="{{ route("language.set", $language->code) }}">
                <img src="{{ asset("uploads/flag/".$language->country->flag) }}" alt="" width="20">
                <span class="mx-1"></span>
                {{ $language->name }}
            </a>
        @endforeach
    </ul>
</li>

<li class="nav-item">
    <a class="nav-link text-white" data-bs-toggle="collapse" href="#collapseWebsite" role="button"
      aria-expanded="false" aria-controls="collapseWebsite">
      <i class="fas fa-laptop"></i>
      <span>{{ __("Website") }}</span>
    </a>
    <ul class="list-group collapse" id="collapseWebsite">
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route("menus.index") }}" id="menus-menu">
          <i class="fas fa-circle invisible"></i>
          <span>{{ __("Menus") }}</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route("pages.index") }}" id="pages-menu">
          <i class="fas fa-circle invisible"></i>
          <span>{{ __("Pages") }}</span>
        </a>
      </li>
    </ul>
  </li>
   {{-- Taleb Menu Here --}}
  <li class="nav-item">
    <a class="nav-link text-white" data-bs-toggle="collapse" href="#collapseProperty" role="button"
      aria-expanded="false" aria-controls="collapseWebsite">
      <i class="fas fa-laptop"></i>
      <span>{{ __("Property") }}</span>
    </a>
    <ul class="list-group collapse" id="collapseProperty">
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route("admin.property.index") }}" id="menus-menu">
          <i class="fas fa-circle invisible"></i>
          <span>{{ __("Property List") }}</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route("admin.property.create") }}" id="pages-menu">
          <i class="fas fa-circle invisible"></i>
          <span>{{ __("Add New Property") }}</span>
        </a>
      </li>
    </ul>
  </li>


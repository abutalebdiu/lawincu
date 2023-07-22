<li class="nav-item">
    <a class="nav-link text-white" data-bs-toggle="collapse" href="#collapseCrm" role="button"
      aria-expanded="false" aria-controls="collapseExample">
      <i class="fas fa-headset"></i>
      <span>{{ __("CRM") }}</span>
    </a>
    <ul class="list-group collapse" id="collapseCrm">

          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route("leads.index") }}" id="leads-menu">
              <i class="fas fa-circle invisible"></i>
              <span>{{ __("Leads") }}</span>
            </a>
          </li>

      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route("lead-stages.index") }}" id="lead-stages-menu">
          <i class="fas fa-circle invisible"></i>
          <span>{{ __("Lead Stages") }}</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route("pipelines.index") }}" id="pipelines-menu">
          <i class="fas fa-circle invisible"></i>
          <span>{{ __("Pipelines") }}</span>
        </a>
      </li>
    </ul>
  </li>


<li class="nav-item">
    <a class="nav-link text-white" data-bs-toggle="collapse" href="#collapseMarketingTools" role="button"
      aria-expanded="false" aria-controls="collapseMarketingTools">
      <i class="fas fa-address-book"></i>
      <span>{{ __("Marketing Tools") }}</span>
    </a>
    <ul class="list-group collapse" id="collapseMarketingTools">
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('senders.index') }}" id="senders-menu">
              <i class="fas fa-circle invisible"></i>
              <span>{{ __("Senders") }}</span>
            </a>
          </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('mailing-lists.index') }}" id="mailing-lists-menu">
              <i class="fas fa-circle invisible"></i>
              <span>{{ __("Mailing List") }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('subscribers.index') }}" id="subscribers-menu">
              <i class="fas fa-circle invisible"></i>
              <span> {{ __("Subscribers") }}</span>
            </a>
          </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route("email-templates.index") }}" id="email-templates-menu">
          <i class="fas fa-circle invisible"></i>
          <span>{{ __("Templates") }}</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('campaigns.index') }}" id="campaigns-menu">
          <i class="fas fa-circle invisible"></i>
          <span>{{ __("Campaigns") }}</span>
        </a>
      </li>
    </ul>
  </li>

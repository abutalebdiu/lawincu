
<li class="nav-item">
    <a class="nav-link text-white" data-bs-toggle="collapse" href="#collapseSupport" role="button"
      aria-expanded="false" aria-controls="collapseSupport">
      <i class="fas fa-address-book"></i>
      <span>{{ __("Support") }}</span>
    </a>
    <ul class="list-group collapse" id="collapseSupport">
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route("support-tickets.index") }}" id="support-tickets-menu">
          <i class="fas fa-circle invisible"></i>
          <span>{{ __("Tickets") }}</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route("contact-messages.index") }}" id="contact-messages-menu">
          <i class="fas fa-circle invisible"></i>
          <span>{{ __("Contact Message") }}</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route("customer-queries.index") }}" id="customer-queries-menu">
          <i class="fas fa-circle invisible"></i>
          <span>{{ __("Customer Queries") }}</span>
        </a>
      </li>
    </ul>
  </li>

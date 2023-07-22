<div class="btn-group language-dropdown">
    <span role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="mx-1">{{ $defaultCompany->name ?? "Dashboard" }}</span>
        <i class="fas fa-angle-down"></i>
    </span>
    <div class="dropdown-menu dropdown-menu-end">
        @foreach ($companies as $company)
            <a class="dropdown-item" href="{{ route("company.set", $company->id) }}">{{ $company->name }}</a>
        @endforeach
    </div>
</div>


<li class="nav-item">
    <a class="nav-link text-white" data-bs-toggle="collapse" href="#collapseBlog" role="button"
      aria-expanded="false" aria-controls="collapseBlog">
      <i class="fas fa-blog"></i>
      <span>{{ __("Blog") }}</span>
    </a>
    <ul class="list-group collapse" id="collapseBlog">
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route("blog-categories.index") }}" id="blog-categories-menu">
              <i class="fas fa-circle invisible"></i>
              <span>{{ __("Categories") }}</span>
            </a>
          </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route("tags.index") }}" id="tags-menu">
          <i class="fas fa-circle invisible"></i>
          <span>{{ __("Tags") }}</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route("posts.index") }}" id="posts-menu">
          <i class="fas fa-circle invisible"></i>
          <span>{{ __("Posts") }}</span>
        </a>
      </li>
    </ul>
  </li>

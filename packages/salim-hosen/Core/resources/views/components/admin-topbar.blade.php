 @auth
     @if (auth()->id() == 1)
         <div id="top-bar" class="">
             <div class="container d-flex justify-content-end gap-5">

                 <div class="dropdown open">
                     <a class="dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                         Welcome Page
                     </a>
                     <div class="dropdown-menu" aria-labelledby="triggerId">
                         <a class="dropdown-item" href="{{ route('welcome.customize') }}">Customize</a>
                         <a class="dropdown-item" href="{{ route('welcome') }}">Preview</a>
                     </div>
                 </div>

                 <div class="dropdown open">
                     <a class="dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                         Admin
                     </a>
                     <div class="dropdown-menu" aria-labelledby="triggerId">
                         <a class="dropdown-item" href="{{ url('home') }}">Admin Panel</a>
                         <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                     </div>
                 </div>

             </div>
         </div>
     @endif
 @endauth

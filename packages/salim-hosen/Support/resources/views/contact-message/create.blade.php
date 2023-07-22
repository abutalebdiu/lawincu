@extends('layouts.app')

@section("meta_tags")
    <title>{{ __("Create Contact Message") }}</title>
    <meta name="description" content="Zone Details">
    <meta name="keywords" content="zone,zone_show">
@endsection

@section('content')

<!------------------------ Contact Us Area  ---------------------->
<section class="py-5">
    <div class="container">
      <div class="row mb-3">
        <div class="col-12">
          <div class="text-center">
            <h4 class="text-center">{{ __("CONTACT US") }}</h4>
            <h6 class="text-center">{{ __("Characteristics and advantages of Riadah incubators startups studio") }}</h6>
          </div>
        </div>
      </div>
      <div class="row">
          <div class="col-md-8">
              <div class="card">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0">{{ __("Massage") }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('contact-messages.store') }}" method="POST">
                        @csrf

                          <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3">
                                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="{{ __("First Name") }}">
                                @error("first_name")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <input type="text" name="last_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="{{ __("Last Name") }}">
                                @error("last_name")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 col-sm-12 mb-3">
                                <input type="text" name="email" class="form-control @error('first_name') is-invalid @enderror" placeholder="{{ __("Email") }}">
                                @error("email")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <textarea name="message" name="text" id="textarea" class="form-control @error('first_name') is-invalid @enderror" cols="80" rows="6" placeholder="{{ __("Write your massage") }}"></textarea>
                            @error("message")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                          </div>
                          <button type="submit" class="btn btn-primary">{{ __("Send Message") }}</button>
                    </form>
                </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0">{{ __("Head Office") }}</h6>
                </div>
                <div class="card-body">
                    <address>
                          <p>
                            <i class="fas fa-map-marker-alt"></i>
                            <span class="mx-1"></span>
                            <span>{{ __("Riadah Incubators Startup Studio And corporate factory - Khaldiya Towers - 4th Tower - Faisal Bin Turki Road - Office No. 6 - Floor 13 - Riyadh") }}</span>
                          </p>
                          <p>
                            <a href="tel:{{ config('settings.phone') }}">
                                <i class="fas fa-phone-alt"></i>
                                <span class="mx-1"></span>
                                <span>{{ config('settings.phone') }}</span>
                              </a>
                            </p>
                          <p>
                            <a href="mailto:{{ config('settings.email') }}">
                                <i class="far fa-envelope"></i>
                                <span class="mx-1"></span>
                                <span>{{ config('settings.email') }}</span>
                              </a>
                            </p>
                      </address>
                      <div>
                        <h6>{{ __("Connect With Us") }}</h6>
                        <ul class="d-flex">
                          <li class="me-2"><a href="https://www.facebook.com/riad.ahin" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                          <li class="me-2"><a href="https://twitter.com/riadahin" target="_blank"><i class="fab fa-twitter"></i></a></li>
                          <li class="me-2"><a href=""><i class="fab fa-linkedin-in" target="_blank"></i></a></li>
                          <li class="me-2"><a href=""><i class="fab fa-instagram" target="_blank"></i></a></li>
                        </ul>
                      </div>
                </div>
              </div>
          </div>
      </div>
    </div>
</section>



@endsection



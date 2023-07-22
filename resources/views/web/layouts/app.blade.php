@php
    $locale = app()->getLocale();
@endphp

<!DOCTYPE html>
@if ($locale == 'en')
    <html lang="en" dir="auto">
@elseif($locale == 'ar')
    <html lang="ar" dir="rtl">
@endif

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo/logo.png" type="image/gif" sizes="16x16">
    <meta name="csrf-token" content="">
    <title> @yield('title') - @lang('homepage.amlakincu') </title>
    <link rel="canonical" href="https://amlakincu.com" />
    <meta name='description' content="" />
    <meta name='keywords' content="Amlak" />
    <meta property="og:url" content="https://amlakincu.com" />
    <meta property="og:type" content="Amlak Incubator" />
    <meta property="og:title" content="International Business Incubator" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="img/logo/logo.png" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Amlak Incubator" />
    <meta name="twitter:site" content="Amlak Incubator" />
    <meta name="distribution" content="Global">
    <meta name="Developed By" content="AG Group" />
    <meta name="Developer" content="AG Group Team" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Amlak Incubator" />

    <!--    BOOSTRAP-->
    <!--    BOOSTRAP-->
    @if ($locale == 'en')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @else
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
            integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    @endif
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!--    GOOGLE FONT-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!--    FONT AWSOME-->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--    SLICK SLIDER-->
    <link rel="stylesheet" href="{{ asset('web/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/slick.css') }}">

    @stack('style')

    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!--    MAIN CSS-->
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">

    @if ($locale == 'ar')
        <link rel="stylesheet" href="{{ asset('web/css/arabic.css') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('web/css/responsive.css') }}">


</head>

<body>
    <!-- TOP HEADER PART START -->
    <section class="header-top py-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-end">
                    <div class="menubar">
                        <ul>
                            <li>
                                @if ($locale == 'en')
                                    <a class="no-border head-lang-button"
                                        href="{{ request()->fullUrlWithQuery(['lang' => 'ar']) }}"> <img
                                            class="lang-flag" src="{{ asset('web/img/icon/saudi-arabia.png') }}"
                                            alt="">
                                        @lang('homepage.arabic')</a>
                                @elseif($locale == 'ar')
                                    <a class="no-border head-lang-button"
                                        href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}"> <img
                                            class="lang-flag" src="{{ asset('web/img/icon/english.jpg') }}"
                                            alt=""> @lang('homepage.english')</a>
                                @endif

                            </li>
                            <li class="sub-btn button1">
                                <a href="#"> <i class="fa fa-user-circle"></i> @lang('homepage.account') <i
                                        class="fa-solid fa-angle-down"></i>
                                </a>
                                <div class="sub-menu">
                                    <a href="#"> @lang('homepage.signin')</a>
                                    <a href="#"> @lang('homepage.signup')</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- TOP HEADER PART END -->
    <!--    HEADER SECTION-->
    <header class="d-flex align-items-center py-2">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-12 col-lg-2">
                    <div class="logo d-flex justify-content-between align-items-center">
                        <a href="#">
                            <img src="{{ asset('web') }}/img/logo/logo.png" alt="Logo">
                        </a>
                        <i class="fa fa-bars d-lg-none" onClick="mobileClick()" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="col-md-10 d-none d-lg-block">
                    <div class="menubar">
                        <ul>
                            <li>
                                <a href="{{ route('welcome') }}">@lang('homepage.homepage') </a>
                            </li>
                            <li>
                                <a href="{{ route('aboutus') }}"> @lang('homepage.aboutus') </a>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--    HEADER SECTION END-->



    <!-- MOBILE MENU-->
    <div id="mobile-menu" class="mobile-menu">
        <!-- accordion-->
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="mobile-logo mb-5">
                <a href="{{ route('welcome') }}">
                    <img src="{{ asset('web') }}/img/logo/logo.png" alt="mobile-logo">
                </a>
                <i id="mobile-cross" class="fa fa-times" onClick="mobileClick()"></i>
            </div>

            <div class="accordion-item custom ">
                <h2 class="accordion-header" id="flush-headingThree">
                    <a href="{{ route('welcome') }}">
                        <button class="accordion-button custom collapsed none" type="button">
                            @lang('homepage.homepage')
                        </button>
                    </a>
                </h2>
            </div>
            <div class="accordion-item custom">
                <h2 class="accordion-header" id="flush-headingThree">
                    <a href="{{ route('aboutus') }}">
                        <button class="accordion-button custom collapsed none" type="button">
                            @lang('homepage.aboutus')
                        </button>
                    </a>
                </h2>
            </div>


        </div>
    </div>

    <div id="mobileOverlay" class="mobile-overlay" onClick="mobileClick()"></div>
    <!--   END MOBILE MENU-->

    @yield('content')

    <!--    FOOTER SECTION-->
    <footer class="footer-part pt-5 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <img class="" src="{{ asset('web') }}/img/logo/logo.png" alt="logo">
                        </div>
                        <p class="small-text text-white pt-4">
                            @lang('homepage.webaddress')
                        </p>
                        <p> <i class="fa fa-phone"></i> +966551175959 </p>
                        <p> <i class="fa fa-envelope"></i> info@amlakin.com </p>
                        <div class="social-media-link mb-3">
                            <p class="border-bottom py-1"><b> @lang('homepage.connectwithus') </b></p>
                            <ul class="d-flex">
                                <li class="mx-2">
                                    <a href="https://www.facebook.com/" target="_blank"><i
                                            class="fa-brands fa-facebook"></i></a>
                                </li>
                                <li class="mx-2">
                                    <a href="https://twitter.com/" target="_blank"><i
                                            class="fa-brands fa-twitter"></i></a>
                                </li>
                                <li class="mx-2">
                                    <a href="https://www.instagram.com/" target="_blank"><i
                                            class="fa-brands fa-instagram"></i></a>
                                </li>
                                <li class="mx-2">
                                    <a href="https://www.youtube.com/" target="_blank"><i
                                            class="fa-brands fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="footer-title">
                        <p class="border-bottom mb-4 text-white">Search Property </p>
                    </div>
                    <div class="footer-link">
                        <ul>
                            <li>
                                <a href="#"> Property for sale </a>
                            </li>
                            <li>
                                <a href="#">Property for Lease </a>
                            </li>
                            <li>
                                <a href="#">Property or space Auctions </a>
                            </li>
                            <li>
                                <a href="#">Businesses for Sale </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="footer-title">
                        <p class="border-bottom mb-4 text-white">Marketplace</p>
                    </div>
                    <div class="footer-link">
                        <ul>
                            <li>
                                <a href="#"> Property Appraiser </a>
                            </li>
                            <li>
                                <a href="#">Mortgage</a>
                            </li>
                            <li>
                                <a href="#">Building Insurance </a>
                            </li>
                            <li>
                                <a href="#">Safety and Security </a>
                            </li>
                            <li>
                                <a href="#">Real Estate Developer </a>
                            </li>
                            <li>
                                <a href="#">Short Units </a>
                            </li>
                            <li>
                                <a href="#">Photography </a>
                            </li>
                            <li>
                                <a href="#">Add a partner </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="footer-title">
                        <p class="border-bottom mb-4 text-white">Business Sector </p>
                    </div>
                    <div class="footer-link">
                        <ul>
                            <li>
                                <a href="#"> Property for sale</a>
                            </li>
                            <li>
                                <a href="#">Property for Lease</a>
                            </li>
                            <li>
                                <a href="#">Property or space Auctions</a>
                            </li>
                            <li>
                                <a href="#">Businesses for Sale </a>
                            </li>
                        </ul>
                    </div>
                    <p class="border-bottom text-white py-1"><b>Contact</b></p>
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="@lang('homepage.email')"
                                aria-label="Email" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2"> <i
                                    class="fa fa-paper-plane" aria-hidden="true"></i> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </footer>
    <!--    FOOTER SECTION END-->
    <!-- COPYRIGHT START -->
    <section class="copyright-part py-3">
        <div class="container">
            <div class="text-center">
                <p class="text-white">Copyright &copy; 2023 | All Rights Reserved
                    <span> @lang('homepage.amlakincu')</span>
                </p>
            </div>
        </div>
    </section>
    <!-- COPYRIGHT END -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--    BOOSTRAP-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('web') }}/js/slick.min.js"></script>
    <script src="{{ asset('web') }}/js/main.js"></script>
    <!-- Toastr script CDN -->
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>

    <script type="text/javascript">
        $(document).ready(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

    @stack('script')

</body>

</html>

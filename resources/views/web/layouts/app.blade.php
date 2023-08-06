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
    <link rel="icon" href="{{ asset('web/img/logo/favicon.jpg') }}" type="image/gif" sizes="16x16">
    <meta name="csrf-token" content="">
    <title> @yield('title') - @lang('homepage.lawincu') </title>
    <link rel="canonical" href="https://lawincu.com" />
    <meta name='description' content="Law Incubator" />
    <meta name='keywords' content="Law Incubator" />
    <meta property="og:url" content="https://lawincu.com" />
    <meta property="og:type" content="Law Incubator" />
    <meta property="og:title" content="Law Incubator" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="img/logo/logo.png" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Law Incubator" />
    <meta name="twitter:site" content="Law Incubator" />
    <meta name="distribution" content="Global">
    <meta name="Developed By" content="AG Group" />
    <meta name="Developer" content="AG Group Team" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Law Incubator" />

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
        <div class="container">
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
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-2">
                    <div class="logo d-flex justify-content-between align-items-center">
                        <a href="#">
                            <img src="{{ asset('web') }}/img/logo/logo.jpg" alt="Logo">
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
                                <a href="#"> @lang('homepage.services') </a>
                            </li>
                            <li>
                                <a href="#"> @lang('homepage.agency') </a>
                            </li>
                            <li>
                                <a href="#"> @lang('homepage.consultancy') </a>
                            </li>
                            <li>
                                <a href="#"> @lang('homepage.blog') </a>
                            </li>
                            <li>
                                <a href="#"> @lang('homepage.help') </a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}"> @lang('homepage.contact') </a>
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
                    <img src="{{ asset('web') }}/img/logo/logo.jpg" alt="mobile-logo">
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
                <div class="col-12 col-sm-4 col-md-4 text-white">
                    <h4>Tax <span class="text-info">Incubator</span></h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem velit quae fugiat !</p>
                </div>
                <div class="col-12 col-sm-8 col-md-8">
                    <div class="footercontact text-white border border-secondary pt-2 px-2">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4">
                                <p><span class="text-info">Say Hello</span> <i class="fa fa-phone"></i> +966551175959</p>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <p><span class="text-info">Inquiry</span> <i class="fa fa-envelope"></i> info@lawincu.com </p>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="social-media-link d-md-flex ml-2">
                                    <p class="text-info">Follow</p>
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
                    </div>
                </div>
            </div>
            <div class="row mt-md-5">
                <div class="col-12 col-lg-4">
                    <div class="footer-title">
                        <p class="border-bottom mb-4 text-white">About Us </p>
                    </div>
                    <div class="footer-link">
                        <ul>
                            <li>
                                <a href="#">Legal Aid Servics </a>
                            </li>
                            <li>
                                <a href="#">Contact Information </a>
                            </li>
                            <li>
                                <a href="#">Our Contact Policy </a>
                            </li>
                            <li>
                                <a href="#">Services Policy </a>
                            </li>
                            <li>
                                <a href="#">Services Information </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="footer-title">
                        <p class="border-bottom mb-4 text-white">Important Link</p>
                    </div>
                    <div class="footer-link">
                        <ul>
                            <li>
                                <a href="#"> Advisor Booking </a>
                            </li>
                            <li>
                                <a href="#">Find Your Topic</a>
                            </li>
                            <li>
                                <a href="#">Search Agency</a>
                            </li>
                            <li>
                                <a href="#">Help Center </a>
                            </li>
                            <li>
                                <a href="#">About Our Company </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <p class=" text-white py-1"><b>Join with us</b></p>
                    <form action="" method="post">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" placeholder="@lang('homepage.email')"
                                aria-label="Email">
                            <button class="btn btn-info mt-3" type="button">Subscribe</button>
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
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                    <p class="pt-2">Copyright &copy; 2023 | All Rights Reserved
                        <span> Law Incubator</span>
                    </p>
                </div>
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="footer-bottom-menu">
                        <ul>
                            <li><a href="">Privacy Policy</a></li>
                            <li><a href="">Accessibility</a></li>
                            <li><a href="">Business Policy</a></li>
                            <li><a href="">Terms & Condition</a></li>
                            <li><a href="">Help</a></li>
                        </ul>
                    </div>
                </div>
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

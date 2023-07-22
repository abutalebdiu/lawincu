//        MOBILE MENU
function mobileClick() {
    $("#mobile-menu").toggleClass('mobileAdd');
    $("#mobileOverlay").toggleClass('mobile-overlay');
}
//        MOBILE MENU END

$(window).scroll(function() {
    $('header').toggleClass('scrolled', $(this).fadeIn().scrollTop() > 65);
});


$('.autoplay').slick({
    slidesToShow: 6,
    slidesToScroll: 3,
    rtl: false,
    autoplay: true,
    autoplaySpeed: 2000,
    dots: false,
    arrows: false,
    nextArrow: $('.nxt'),
    prevArrow: $('.prv'),
    responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 2,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 350,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        }

    ]

});


// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.select2').select2();
});
(function ($) {
    'use strict';

    // 1.0 Fullscreen Code

    $(window).on('resizeEnd', function () {
        $(".welcome_area, .welcome_slides .single_slide, .single_slide, .coming-soon-area").height($(window).height());
    });

    $(window).on('resize', function () {
        if (this.resizeTO) clearTimeout(this.resizeTO);
        this.resizeTO = setTimeout(function () {
            $(this).trigger('resizeEnd');
        }, 300);
    }).trigger("resize");


    // 2.0 Welcome Slider active code

    if ($.fn.owlCarousel) {
        $(".welcome_slides").owlCarousel({
            items: 1,
            margin: 0,
            loop: true,
            nav: true,
            navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
            dots: false,
            autoplay: true,
            autoplayTimeout: 7000,
            smartSpeed: 500,
            autoplayHoverPause: false
        });
    }

    var owl = $('.welcome_slides');
    owl.owlCarousel();
    owl.on('translate.owl.carousel', function (event) {
        $('.owl-item .single_slide .slide_text h2').removeClass('animated').hide();
        $('.owl-item .single_slide .slide_text h3').removeClass('animated').hide();
        $('.owl-item .single_slide .slide_text .btn.btn-1').removeClass('animated').hide();
        $('.owl-item .single_slide .slide_text .btn.btn-2').removeClass('animated').hide();
    })

    owl.on('translated.owl.carousel', function (event) {
        $('.owl-item.active .single_slide .slide_text h2').addClass('animated custom_slideInUp').show();
        $('.owl-item.active .single_slide .slide_text h3').addClass('animated custom_slideInUp_2').show();
        $('.owl-item.active .single_slide .slide_text .btn.btn-1').addClass('animated custom_slideInUp_btn_1').show();
        $('.owl-item.active .single_slide .slide_text .btn.btn-2').addClass('animated custom_slideInUp_btn_2').show();
    })



    // 2.0 search box active code
    $(".main_menu_area .search_button").on('click', function () {
        $("#search").css('transform', 'scale(1,1)');
        $(".search_box_area").css({
            "transform": "scale(1,1)",
            "transition-delay": "1200ms"
        });
    });

    $("#close_button").on('click', function () {
        $("#search").css('transform', 'scale(1,0)');
        $(".search_box_area").css({
            "transform": "scale(1,0)",
            "transition-delay": "0ms"
        });
    });

    // 3.0 color changer active code

    $("#color_1").on('click', function () {
        $('body').removeClass('color_1 color_2 color_3');
    });

    $("#color_2").on('click', function () {
        $('body').addClass('color_1').removeClass('color_2 color_3');
    });

    $("#color_3").on('click', function () {
        $('body').addClass('color_2').removeClass('color_1 color_3');
    });

    $("#color_4").on('click', function () {
        $('body').addClass('color_3').removeClass('color_1 color_2');
    });

    // 3.0 magnific-popup active code 

    $('.magnific-popup').magnificPopup({
        type: 'image'
    });

    $('.video_btn').magnificPopup({
        disableOn: 0,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: true,
        fixedContentPos: false
    });

    // 4.0 counterup active code

    $('.counter').counterUp({
        delay: 10,
        time: 3000
    });

    // 5.0 team slider active code

    $(".testimonials").owlCarousel({
        items: 3,
        margin: 0,
        loop: true,
        nav: false,
        dots: true,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 1
            }
        }
    });

    // 6.0 team slider active code

    $(".testimonials_home2").owlCarousel({
        items: 2,
        margin: 50,
        loop: true,
        nav: false,
        dots: true,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 2
            }
        }
    });

    // 7.0 scrollUp active code
    $.scrollUp({
        scrollName: 'scrollUp',
        scrollDistance: 450,
        scrollFrom: 'top',
        scrollSpeed: 500,
        easingType: 'linear',
        animation: 'fade',
        animationSpeed: 200,
        scrollTrigger: false,
        scrollTarget: false,
        scrollText: '<i class="fa fa-angle-up"></i>',
        scrollTitle: false,
        scrollImg: false,
        activeOverlay: false,
        zIndex: 2147483647
    });

    // 8.0 meanmenu active code
    $('.main_menu_area .mainmenu nav').meanmenu();

    // 9.0 wow active code
    new WOW().init();

    // 10.0 PreventDefault a click
    $("a[href='#']").on('click', function ($) {
        $.preventDefault();
    });

    // 11.0 countdown active code
    $('[data-countdown]').each(function () {
        var $this = $(this),
            finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function (event) {
            $(this).find(".days").html(event.strftime("%D"));
            $(this).find(".hours").html(event.strftime("%H"));
            $(this).find(".minutes").html(event.strftime("%M"));
            $(this).find(".seconds").html(event.strftime("%S"));
        });
    });

    // 12.0 Preloader active code
    $(window).load(function () {
        $('body').css('overflow-y', 'visible');
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });

})(jQuery);
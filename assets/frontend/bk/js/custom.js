(function ($) {
    'use strict';

    // 1.0 Full Screen Code
    $(window).on('resizeEnd', function () {
        $(".cooming_soon_area, .maintenence_area").height($(window).height());
    });

    $(window).on('resize', function () {
        if (this.resizeTO) clearTimeout(this.resizeTO);
        this.resizeTO = setTimeout(function () {
            $(this).trigger('resizeEnd');
        }, 300);
    }).trigger("resize");

    $(window).on('resizeEnd', function () {
        $(".welcome_area, #edu-n-slider img").height('660px');
    });

    $(window).on('resize', function () {
        if (this.resizeTO) clearTimeout(this.resizeTO);
        this.resizeTO = setTimeout(function () {
            $(this).trigger('resizeEnd');
        }, 300);
    }).trigger("resize");

    // 2.0 search box active code
    $(".main_menu_area .search_button").on('click', function () {
        $("#search").slideToggle('slow');
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
        time: 2000
    });

    // 5.0 testimonials active code
    if ($.fn.owlCarousel) {
        $(".testimonials").owlCarousel({
            items: 1,
            margin: 30,
            loop: true,
            nav: false,
            dots: true,
            autoplay: true,
            smartSpeed: 800,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn'
        });
    }
    // 6.0 Single Portfolio slider active code
    if ($.fn.owlCarousel) {
        $(".single_gallary_slider").owlCarousel({
            items: 1,
            margin: 30,
            loop: true,
            nav: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            dots: false,
            autoplay: true,
            smartSpeed: 800,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn'
        });
    }

    // 7.0 Single Portfolio slider active code
    if ($.fn.owlCarousel) {
        $(".partners_thumbs.slide").owlCarousel({
            items: 6,
            margin: 30,
            loop: true,
            nav: false,
            dots: false,
            autoplay: true,
            smartSpeed: 500,
            responsive: {
                0: {
                    items: 2
                },
                480: {
                    items: 3
                },
                768: {
                    items: 6
                }
            }
        });
    }

    // 8.0 scrollUp active code
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
    
    // 9.0 sticky header active code
    if ($.fn.sticky) {
        $("#sticky_menu").sticky({
            topSpacing: 0
        });
    }

    // 10.0 meanmenu active code
    $('.main_menu_area .mainmenu nav').meanmenu();

    // 11.0 PreventDefault a click
    $("a[href='#']").on('click', function ($) {
        $.preventDefault();
    });
    // 12.0 countdown clock active code
    $('#clock').countdown('2017/10/10', function (event) {
        var $this = $(this).html(event.strftime('' + '<span>%w</span> weeks ' + '<span>%d</span> days ' + '<span>%H</span> hr ' + '<span>%M</span> min ' + '<span>%S</span> sec'));
    });

    // 13.0 image zoom lens active js
    if ($.fn.simpleLens) {
        $('.simpleLens-lens-image').simpleLens({});
    }
    
    // 14.0 wow active code
     new WOW().init();
    
    // 15.0 Preloader active code
    $(window).load(function () {
        $('body').css('overflow-y', 'visible');
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });

})(jQuery);
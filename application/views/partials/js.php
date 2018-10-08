<!-- Placed At The End Of The Document So Page Loads Faster -->
<script src="<?php echo base_url('assets/frontend/assets/js/jquery-2.0.3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/frontend/assets/js/jquery-migrate-1.2.1.min.js') ?>"></script>
<script src="<?php echo base_url('assets/frontend/assets/bootstrap/js/bootstrap.min.js') ?>"></script>

<!-- jQuery REVOLUTION Slider  -->
<script src="<?php echo base_url('assets/frontend/assets/rs-plugin/js/jquery.themepunch.tools.min.js')?>"></script>
<script src="<?php echo base_url('assets/frontend/assets/rs-plugin/js/jquery.themepunch.revolution.min.js')?> "></script>

<script src="<?php echo base_url('assets/frontend/assets/carouFredSel-6.2.1/jquery.carouFredSel-6.2.1.js')?>"></script>
<script src="<?php echo base_url('assets/frontend/assets/prettyPhoto/js/jquery.prettyPhoto.js')?> "></script>
<script src="<?php echo base_url('assets/frontend/assets/jflickrfeed/jflickrfeed.min.js') ?>"></script>
<script src="<?php echo base_url('assets/frontend/assets/UItoTop/js/easing.js')?>"></script>
<script src="<?php echo base_url('assets/frontend/assets/UItoTop/js/jquery.ui.totop.min.js')?>"></script>
<script src="<?php echo base_url('assets/frontend/assets/isotope-site/jquery.isotope.min.js')?>"></script>
<script src="<?php echo base_url('assets/frontend/assets/FitVids.js/jquery.fitvids.js')?>"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.banner').revolution({
            delay:9000,
            startwidth:1100,
            startheight:450,
            startWithSlide:0,

            fullScreenAlignForce:"off",
            autoHeight:"off",
            minHeight:"off",

            shuffle:"off",

            onHoverStop:"on",

            thumbWidth:100,
            thumbHeight:50,
            thumbAmount:3,

            hideThumbsOnMobile:"off",
            hideNavDelayOnMobile:1500,
            hideBulletsOnMobile:"off",
            hideArrowsOnMobile:"off",
            hideThumbsUnderResoluition:0,

            hideThumbs:0,
            hideTimerBar:"off",

            keyboardNavigation:"on",

            navigationType:"bullet",
            navigationArrows:"solo",
            navigationStyle:"preview1",

            navigationHAlign:"center",
            navigationVAlign:"bottom",
            navigationHOffset:0,
            navigationVOffset:30,

            soloArrowLeftHalign:"left",
            soloArrowLeftValign:"center",
            soloArrowLeftHOffset:20,
            soloArrowLeftVOffset:0,

            soloArrowRightHalign:"right",
            soloArrowRightValign:"center",
            soloArrowRightHOffset:20,
            soloArrowRightVOffset:0,


            touchenabled:"on",
            swipe_velocity:"0.7",
            swipe_max_touches:"1",
            swipe_min_touches:"1",
            drag_block_vertical:"false",

            parallax:"mouse",
            parallaxBgFreeze:"on",
            parallaxLevels:[10,7,4,3,2,5,4,3,2,1],
            parallaxDisableOnMobile:"off",

            stopAtSlide:-1,
            stopAfterLoops:-1,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            hideSliderAtLimit:0,

            dottedOverlay:"none",

            spinned:"spinner4",

            fullWidth:"off",
            forceFullWidth:"off",
            fullScreen:"off",
            fullScreenOffsetContainer:"#topheader-to-offset",
            fullScreenOffset:"0px",

            panZoomDisableOnMobile:"off",

            simplifyAll:"off",

            shadow:0
        });

        jQuery("a[rel^='prettyPhoto']").prettyPhoto({
            theme: 'light_square',
            social_tools: false
        });
        // FitVids
        jQuery(".responsive-video-wrapper").fitVids();
        // jflickrfeed
        jQuery('.flickr-photos-list').jflickrfeed({
            limit: 9,
            qstrings: {
                id: '71865026@N00'
            },
            itemTemplate: '<li><a href="{{image_b}}"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
        });
        // jQuery UItoTop
        jQuery().UItoTop({ easingType: 'easeOutQuart' });
        // Skin Chooser
        jQuery(".color-skin").click(function () {
            var cls = this.id;
            jQuery(".color-skin").removeClass("active");
            jQuery(this).addClass("active");
            jQuery("#main-wrapper").removeClass();
            jQuery("#main-wrapper").addClass(cls);
        });

    });

    // jQuery CarouFredSel
    var caroufredsel = function () {
        jQuery('#caroufredsel-portfolio-container').carouFredSel({
            responsive: true,
            scroll: 1,
            circular: false,
            infinite: false,
            items: {
                visible: {
                    min: 1,
                    max: 3
                }
            },
            prev: '#portfolio-prev',
            next: '#portfolio-next',
            auto: {
                play: false
            }
        });
        jQuery('#caroufredsel-clients-container').carouFredSel({
            responsive: true,
            scroll: 1,
            circular: false,
            infinite: false,
            items: {
                visible: {
                    min: 1,
                    max: 4
                }
            },
            prev: '#client-prev',
            next: '#client-next',
            auto: {
                play: false
            }
        });
    };
    jQuery(window).load(function () {
        caroufredsel();
    });
    jQuery(window).resize(function () {
        caroufredsel();
    });
</script>

<script type="text/javascript">
  $('#phone_number').click(function(){
     $(this).find('label').text( $(this).data('last') );
  });

  $("#btc_amount").on("input", function (e) {
    var amount = this.value;
    var label = $('#ngn_amount');
    $.getJSON('get_exchange_rate', function (json) {
      var total = (amount * json.amount_ngn * json.amount_usd);
      //alert(total.toFixed(3));
      label.val(total.toFixed(3));
     });
 });

  $("#ngn_amount").on("input", function (e) {
    var amount = this.value;
    var label = $('#btc_amount');
    $.getJSON('get_exchange_rate', function (json) {
      var total = amount/(json.amount_ngn * json.amount_usd);
      //alert(total.toFixed(3));
      label.val(total.toFixed(3));
     });
  });

</script>


<script type="text/javascript"
        src="//platform-api.sharethis.com/js/sharethis.js#property=599890a7192276001242ae7a&product=inline-share-buttons">
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5998a2ba1b1bed47ceb058b4/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
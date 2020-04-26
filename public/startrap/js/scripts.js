/* 
    Template name : Startrap
    Template URI  : http://www.templatespremium.net/startrap/
    Description   : Startrap is a Bootstrap landing page template for Mobile Apps.
    Version       : 1.0
    Author        : Rafael Memmel
    Author URI    : http://www.rafamemmel.com
*/

// Get IE Version Function
/* ================================================================================================= */
function getInternetExplorerVersion() {
    var rv = -1;
    var ua = navigator.userAgent;
    var re = '';
    if (navigator.appName == 'Microsoft Internet Explorer') {
        re  = new RegExp('MSIE ([0-9]{1,}[\.0-9]{0,})');
        if (re.exec(ua) !== null) {
            rv = parseFloat(RegExp.$1);
        } 
    } else if (navigator.appName == 'Netscape') {
        re = new RegExp('Trident/.*rv:([0-9]{1,}[\.0-9]{0,})');
        if (re.exec(ua) !== null) {
            rv = parseFloat(RegExp.$1);
        }
    }
  return rv;
}

$.noConflict();

(function ($) {
    "use strict";

    var $window = $(window);
    var $document = $(document);

    //Window Load
    /*=================================================================================================*/
    $window.on('load', function(){
        //Preloader
        /*----------------------------------------------------------------------*/
        var $preloader = $('#preloader');
        if ($preloader.length) {
            var ie = getInternetExplorerVersion();
            if (ie == '-1' || ie == '11') {
                //Good Browsers
                $preloader.fadeOut('slow', function() {
                    $(this).remove();
                });
                if(window.complete){
                    $window.trigger('load');
                }
            } else {
                //Older versions of Internet Explorer
                var myPreloader = document.querySelector('#preloader');
                myPreloader.style.display = 'none';
            }
        }
    });

    //Document Ready
    /*=================================================================================================*/
    $document.on('ready', function(){
        //Load CSS Animations
        /*----------------------------------------------------------------------*/
        var ie = getInternetExplorerVersion();
        if (ie == '-1' || ie == '11') {
            if ($window.width() > 800) {
                var wow = new WOW({
                    boxClass: 'wow',          //Animated element css class (default is wow)
                    animateClass: 'animated', //Animation css class (default is animated)
                    offset: 0,                //Distance to the element when triggering the animation (default is 0)
                    mobile: false             //Trigger animations on mobile devices (true is default)
                });
                wow.init();
            }
        }
        //Transparent Navbar
        /*----------------------------------------------------------------------*/
        var $navbar = $('#menu');
        if ($navbar.length) {
            $window.on('scroll', function () {
                //Remove focus color style after scroll
                $('.navbar-collapse a').blur();
                //Add or remove nav-color class
                if ($window.width() > 800) {
                    if ($document.scrollTop() < 100) {
                        $navbar.removeClass('nav-color');
                    } else {
                        $navbar.addClass('nav-color');
                    }
                }
            });
        }
        //Scrolling Nav
        /*----------------------------------------------------------------------*/
        $('.scroll-nav').on('click',function(event) {
            event.preventDefault();
            $('html, body').animate({scrollTop: $($(this).attr('href')).offset().top}, 1000);
        });
        //Close navbar collapse when link clicked on mobile
        /*----------------------------------------------------------------------*/
        $('.navbar-collapse a.scroll-nav').on('click', function(){
            $(".navbar-collapse").collapse('hide');
        });
        //Parallax
        /*----------------------------------------------------------------------*/
        $window.stellar({
            horizontalScrolling: false,
            responsive: true
        });
        //Slick Carousel
        /*----------------------------------------------------------------------*/
        //Screens carousel
        var $screensSlider = $('#screens-slider');
        if ($screensSlider.length) {
            $screensSlider.slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 5000,
                arrows: false,
                dots: true
            });
        }
        //Client carousel
        var $clientsSlider = $('#clients-slider');
        if ($clientsSlider.length) {
            $clientsSlider.slick({
                slidesToShow: 5,
                slidesToScroll: 5,
                autoplay: true,
                autoplaySpeed: 5000,
                dots: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 481,
                        settings: {
                            arrows: false,
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
        //Reviews carousel
        var $reviewsSlider = $('#reviews-slider');
        if ($reviewsSlider.length) {
            $reviewsSlider.slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 6000,
                dots: true
            });
        }
        //Google Charts
        /*----------------------------------------------------------------------*/
        var $chart = $('.chart');
        if ($chart.length) {
            $chart.each(function () {
                var $this = $(this);
                var color = $(this).data('scale-color');
                setTimeout(function () {
                    $this.filter(':visible').waypoint(function (dgoection) {
                        $(this).easyPieChart({
                            barColor: color,
                            trackColor: 'transparent',
                            onStep: function (from, to, percent) {
                                jQuery(this.el).find('.percent').text(Math.round(percent));
                            }
                        });
                    }, {offset: '100%'});
                }, 500);
            });
        }
        //Contact Form
        /*----------------------------------------------------------------------*/
        var $contactForm = $('#contact-form');
        if ($contactForm.length) {
            $contactForm.validate({
                submitHandler: function(form) {
                    $.ajax({
                        type: 'POST',
                        url: 'php/email-sender.php',
                        data: {
                            'name': $('#name').val(),
                            'email': $('#email').val(),
                            'message': $('#message').val()
                        },
                        dataType: 'json',
                        success: function (data) {
                            if (data.sent == 'yes') {
                                $('#MessageSent').removeClass('hidden');
                                $('#MessageNotSent').addClass('hidden');
                                $('.submit-button').removeClass('btn-default').addClass('btn-success').prop('value', 'Message Sent');
                                $('#contact-form .form-control').each(function() {
                                    $(this).prop('value', '').parent().removeClass('has-success').removeClass('has-error');
                                });
                            } else {
                                $('#MessageNotSent').removeClass('hidden');
                                $('#MessageSent').addClass('hidden');
                            }
                        }
                    });
                },
                // debug: true,
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                onkeyup: false,
                onclick: false,
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    message: {
                        required: true,
                        minlength: 10
                    }
                },
                messages: {
                    name: {
                        required: 'لطفا نام خود را وارد کنید',
                        minlength: 'نام شما باید بیشتر از 2 حرف باشد'
                    },
                    email: {
                        required: 'ما برای ارتباط به ایمیل شما نیاز داریم',
                        email: 'لطفا یک ایمیل معتبر وارد کنید. مانند example@domain.com'
                    },
                    message: {
                        required: 'لطفا پیام را وارد کنید',
                        minlength: 'پیام شما باید بیشتر از 10 حرف باشد'
                    }
                },
                errorElement: 'span',
                highlight: function (element) {
                    $(element).parent().removeClass('has-success').addClass('has-error');
                    $(element).siblings('label').addClass('hide');
                },
                success: function (element) {
                    $(element).parent().removeClass('has-error').addClass('has-success');
                    $(element).siblings('label').removeClass('hide');
                }
            });
        }
        //Scroll to Top
        /*----------------------------------------------------------------------*/
        var $scrollToTop = $('#scrollToTop');
        if ($scrollToTop.length) {
            //Check to see if the window is top if not then display button
            $window.scroll(function(){
                if ($(this).scrollTop() > 800) {
                    $scrollToTop.fadeIn();
                } else {
                    $scrollToTop.fadeOut();
                }
            });
            //Click event to scroll to top
            $scrollToTop.on('click', function(){
                $('html, body').animate({scrollTop : 0},800);
                return false;
            });
        }
    });
})(jQuery);
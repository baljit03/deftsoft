@extends('front.master')
@section('content')

<style>
    .ds-inner-page-banner {
        background: rgba(0, 0, 0, 0) url(../uploads/bannerImg/1600x548_{{$dataArray["postDetail"]->banner}}) repeat scroll 0 0;
        background-size: cover;	
        float: left;
        height: 548px;
        margin-top: -100px;
        position: relative;
        width: 100%;
        }
    </style>
    <section class="ds-inner-page-banner">

        <div class="container">
            <div class="ds-banner-inside-content">
                <h1> {{$dataArray["postDetail"]->title1}}<br /> 
                    <strong> {{$dataArray["postDetail"]->title2}}</strong></h1>
                <p {!!$dataArray["postDetail"]->title3!!}</p>
            </div>
        </div>
    </section>
    <section class="ds-inner-bg" id="ds-contact-us">
        <div class="ds-inner-hdd">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 ds-inner-wrap">
                        <div class="title-head">
                            <h5>Have a <strong>Question</strong> For us</h5>
                            <p>Enter your details below and we will get back to you.</p>
                        </div>

                        <div class="ds-inner-main"> 
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 ds-inner-content"> 
                                    <div class="contact-form">
                                        @if(Session::has('message'))
                                        <div id="msg_div" class="alert alert-success">
                                            <a class="close" data-dismiss="alert">×</a>
                                            <strong>Success!</strong> {!!Session::get('message')!!}
                                        </div>
                                        <script>
                                            setTimeout(function () {
                                                $("#msg_div").remove();
                                            }, 3000);
                                        </script>


                                        @endif
                                        @if(Session::has('errormessage'))
                                        <div id="msg_div" class="alert alert-danger">
                                            <a class="close" data-dismiss="alert">×</a>
                                            <strong>Failed!</strong> {!!Session::get('errormessage')!!}
                                        </div>
                                        <script>
                                            setTimeout(function () {
                                                $("#msg_div").remove();
                                            }, 3000);
                                        </script>


                                        @endif
                                        <form action="{{url('contact-us-submit')}}" name="contact-us" id="contact-us" method="post">
                                            <div class="form-top-content">
                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                    <input  type="text" class="form-control" id="name" name="name" Placeholder="Your Name" required>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                    <input  type="text" class="form-control" id="mobile" name="phone_number"  Placeholder="Phone Number" required>  
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                    <input  type="text" class="form-control" id="email" name="email" Placeholder="Your Email id" required> 
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                    <textarea class="form-control" id="message"  name="message_content" placeholder="message" maxlength="1000" rows="7"></textarea>
                                                    <p>
                                                        <span>Characters remaining: <span id="rem_post" title="1000">1000</span></span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 ds-submit-btn-outer">
                                                <div class="form-group">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                                    <input type="submit" name="Submit" value="Submit" class="submit-btn">
                                                </div>
                                            </div>
                                        </form> 
                                    </div>                    
                                </div>   
                            </div> 
                        </div> 

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Career Opportunities END-->

    {!!$dataArray["postDetail"]->content!!}
    <?php $finalData = $result = $dataArray['videoTestimonial']->merge($dataArray['textTestinomial']);
    ?>
    @include('front.testinomial-section');
    <script>
        $("#header_menu li").eq(4).addClass('active');
    </script>
    <script>
        $("#message").keyup(function () {
            var cmax = 1000;// $("#rem_" + $(this).attr("id")).attr("title");

            if ($(this).val().length >= cmax) {
                $(this).val($(this).val().substr(0, cmax));
            }

            $("#rem_post").text(cmax - $(this).val().length);

        });

        jQuery.validator.addMethod("nameCustom", function (value, element) {
            return this.optional(element) || /^[a-zA-Z'\s]+$/i.test(value);

        }, "Please Fill Correct Value in Field.");
        jQuery.validator.addMethod("messageCustom", function (value, element) {
            return this.optional(element) || /^[a-zA-Z0-9'\s]+$/i.test(value);

        }, "Please Fill Correct Value in Field.");

        $("body #contact-us").validate({
            rules: {
                name: {
                    required: true,
                    nameCustom: true,
                    maxlength: 20
                },
                phone_number: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 12
                },
                email: {
                    required: true,
                    email: true
                },
                message_content: {
                    required: true,
                    messageCustom: true
                }
            },
            messages: {
                name: {
                    required: "Please enter name",
                    nameCustom: "Please enter vaild name",
                    maxlength: "name allows only 20 characters "
                },
                phone_number: {
                    required: "Please enter phone number",
                    number: "Please enter vaild phone number",
                    minlength: "Please enter vaild phone number",
                    maxlength: "Please enter vaild phone number"
                },
                email: {
                    required: "Please enter email",
                    email: "Please enter vaild email"
                },
                message_content: {
                    required: "Please enter your message",
                    messageCustom: "Please enter alphanumeric data"

                },
            },
            submitHandler: function (form) {
                form.submit();
            }

        });


        $("body").on("click", ".showVideo", function () {
            var me = $(this);
            var videoUrl = me.attr("data-src");
            var HTML_TEMP = '<iframe width="420" height="315" src="' + videoUrl + '?autoplay=1"></iframe>';

            $("#mainpopup_content").html(HTML_TEMP);
            $("#mainpopup").show();
        });


        $(document).ready(function () {
            $('.banner-to-services').on('click', function (event) {
                var target = $($(this).attr('href'));
                if (target.length) {
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 500);
                }
            });

            //Horizontal Tab
            $('#parentHorizontalTab').easyResponsiveTabs({
                type: 'default', //Types: default, vertical, accordion
                width: 'auto', //auto or any width like 600px
                fit: true, // 100% fit in a container
                tabidentify: 'hor_1', // The tab groups identifier
                activate: function (event) { // Callback function if tab is switched
                    var $tab = $(this);
                    var $info = $('#nested-tabInfo');
                    var $name = $('span', $info);
                    $name.text($tab.text());
                    $info.show();
                }
            });

            $('.owl-carousel2').owlCarousel({
                loop: true,
                responsiveClass: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 2,
                        nav: true
                    },
                    1000: {
                        items: 3,
                        nav: true,
                        loop: true
                    }
                }
            });




            $('.owl-carousel, .owl-carousel1').owlCarousel({
                loop: true,
                responsiveClass: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 1,
                        nav: true
                    },
                    1000: {
                        items: 1,
                        nav: true,
                        loop: true
                    }
                }
            });


            $(".navbar-toggle").click(function () {
                $(".navbar-collapse").toggleClass('in');
            });

            // hide #back-top first
            $("#back-top").hide();

            // fade in #back-top
            $(function () {
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 100) {
                        $('#back-top').fadeIn();
                    } else {
                        $('#back-top').fadeOut();
                    }
                });

                // scroll body to 0px on click
                $('#back-top a').click(function () {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });
            });
        });


        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 30,
            responsiveClass: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 1,
                    nav: true
                },
                1000: {
                    items: 1,
                    nav: true,
                    loop: true
                }
            }
        });

    </script>
    @endsection
@extends('front.master')
@section('content')
<?php $finalData = $result = $dataArray['videoTestimonial']->merge($dataArray['textTestinomial']);
?>
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
    <section class="ds-inner-bg" id="ds-business-partner">
        <div class="ds-inner-hdd">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 ds-inner-wrap">
                        <div class="title-head">
                            <h5><strong>Deftsoft help</strong> your brand to reach out for more and assist it to <strong>grow</strong> in the right direction.</h5>
                        </div>

                        <div class="ds-inner-main"> 
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 ds-inner-content"> 
                                    <article class="partner-content-box">

                                        <div class="stepwizard">
                                            <div class="stepwizard-row">
                                                <div class="stepwizard-step step-1">
                                                    <button type="button" class="btn btn-default btn-circle active"><span><i class="fa fa-search"></i></span></button>
                                                    <p>Look</p>
                                                </div>
                                                <div class="stepwizard-step step-2">
                                                    <button type="button" class="btn btn-default btn-circle"><span><i class="fa fa-laptop"></i></span></button>
                                                    <p>Learn</p>
                                                </div>
                                                <div class="stepwizard-step step-3">
                                                    <button type="button" class="btn btn-default btn-circle"><span><i class="fa fa-rocket"></i></span></button>
                                                    <p>Launch</p>
                                                </div> 
                                            </div>
                                        </div>            

                                        <div class="stepwizard-content-box">
                                            <div class="partener-img"><img src="images/patner-img.png"  alt=""/></div>
                                            <p>We help brands to explore new horizons and provide them with our expertise to understand uncharted territories and come out as the winner. Let us work together and take your venture to the pinnacle of success. </p>
                                            <a href="javascript:;" class="click-btn gallary-button">Request Free Consultation</a>
                                        </div>
                                    </article>
                                    <!-- post article End -->                       
                                </div>   
                            </div> 
                        </div> 

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Career Opportunities END-->


    <section class="ds-partner-testimonial" id="ds-partner-testi">
        <div class="container">
            <div class="row">
                <h2>Finding new <strong>horizons together!</strong></h2>
                <p>We believe strongly in the power of collaboration and that is what we promote. We love to help entrepreneurs learn from our business model and look forward to exploring new possibilities. At Deftsoft we bring Entrepreneurs, Early stage ventures, Established companies and startups closer and provide them with a common platform to connect and collaborate. </p>
                <div class="client-testimonial-box">
                    <div class="testimonial-col-left">
                        <div class="testimonial-col-left-content">
                            <i class="fa fa-quote-left"></i>
                            <p>Working with Deftsoft has been a wonderful experience!</p>
                            <p>Their team has been truly amazing and delivered the quality of work that I was looking for. Thanks for the support guys!</p>
                        </div>
                    </div>
                    <div class="testimonial-col-right"><img src="images/tetimonial-img.png"  alt=""/></div>
                </div>

            </div>
        </div>
    </section>
    <!-- partner testimonial END-->

    <section class="ds-register-form" id="ds-register">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="heading-two">
                        <h2>Register Today <strong>for free!</strong></h2> 
                    </div>

                    @if(Session::has('message'))
                    <div id="msg_div" class="alert alert-success">
                        <a class="close" data-dismiss="alert">×</a>
                        <strong>Success!</strong> {!!Session::get('message')!!}
                    </div>
                    <script>
                        $('html,body').animate({scrollTop: $(document).height() * 1 - $(window).height()}, 500);
                        setTimeout(function () {
                            $("#msg_div").remove();
                        }, 8000);
                    </script>


                    @endif
                </div>
                <form action="{{url('save-business-partner-details')}}" name="business_partner_form" id="business_partner_form" method="post">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <input  type="text" class="form-control" name="name" placeholder="Your Name"> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <input  type="text" class="form-control" placeholder="Your Email" name="email"> 
                            </div>

                            <div class="col-sm-12 form-group">
                                <div class="dropdown">
                                    <select id="basic18" name="partner_type" class="selectpicker show-tick form-control">
                                        <option selected="selected" disabled="disabled">Select any one</option>
                                        <option value="Automative">Automative</option>
                                        <option value="Banking and Finance">Banking and Finance</option>
                                        <option value="Education and E-Learning">Education and E-Learning</option>
                                        <option value="Health Care">Health Care</option>
                                        <option value="Independent Software Vendors">Independent Software Vendors</option>
                                        <option value="Logistics and Transport">Logistics and Transport</option>
                                        <option value="Manufacture">Manufacture</option>
                                        <option value="Media and Entertainment">Media and Entertainment</option>
                                        <option value="Professional Services">Professional Services</option>
                                        <option value="Real Estate">Real Estate</option>
                                        <option value="Retail and E-Commerce">Retail and E-Commerce</option>
                                        <option value="Travel and Tourism">Travel and Tourism</option>
                                        <option value="Web and Software">Web and Software</option>
                                        <option value="Others">Others</option>
                                    </select>  
                                </div>
                            </div>

                            <div class="col-sm-12 form-group classification">
                                <p>How would you describe yourself? (Classification)</p>
                                <div class="form-group">
                                    <div class="checkbox gender">
                                        <input id="checkbox-1" class="checkbox-custom" name="classification[]" value="I am a Business Owner/Entrepreneur" type="checkbox"/>
                                        <label for="checkbox-1" class="checkbox-custom-label">I am a Business Owner/Entrepreneur</label>
                                    </div>
                                    <div class="checkbox gender">
                                        <input id="checkbox-2" class="checkbox-custom" name="classification[]" value="I am an Individual looking for a Partnership Opportunity" type="checkbox">
                                        <label for="checkbox-2" class="checkbox-custom-label">I am an Individual looking for a Partnership Opportunity</label>
                                    </div>   
                                    <div class="checkbox gender">
                                        <input id="checkbox-3" class="checkbox-custom"   name="classification[]" value="I am an Investor" type="checkbox">
                                        <label for="checkbox-3" class="checkbox-custom-label">I am an Investor</label>
                                    </div>          
                                    <div class="checkbox gender">
                                        <input id="checkbox-4" class="checkbox-custom" name="classification[]" value="I am a Service Provider"  type="checkbox">
                                        <label for="checkbox-4" class="checkbox-custom-label">I am a Service Provider</label>
                                    </div>          
                                    <div class="checkbox gender">
                                        <input id="checkbox-5" class="checkbox-custom" name="classification[]" value="I am a Student" type="checkbox">
                                        <label for="checkbox-5" class="checkbox-custom-label">I am a Student</label>
                                    </div>                 
                                </div>
                            </div>
                            <div class="col-sm-6 form-group captcha">
                                <div class="captcha-img"><img src="images/captcha.png"  alt=""/></div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <input type="text" class="form-control">
                            </div>
                            <div class="ds-first-btn-outer"> 
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <input type="submit" value="Click To Connect" class="click-btn" id="submit_form" /> 
                            </div>
                        </div>
                    </div>
                </form>                              
            </div>
        </div>
    </section>
    @include('front.testinomial-section')
    <script>

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
    <script>
        $("body #business_partner_form").validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                partner_type: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter name"
                },
                email: {
                    required: "Please enter email",
                    email: "Please enter vaild email"
                },
                partner_type: {
                    required: "Please select"
                },
            },
            submitHandler: function (form) {
                form.submit();
            }

        });</script>

    @endsection
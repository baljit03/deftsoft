@extends('front.master')
@section('content')
<?php
$finalData = $result = $dataArray['videoTestimonial']->merge($dataArray['textTestinomial']);
//echo "<pre>";
//print_r($dataArray["childPostData"]);
//die;
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
    <section class="ds-tc-service" id="tc-services">
        <div class="ds-tc-service-hdd">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 tc-main-wrap">
                        <div class="title-head">
                            {!!$dataArray["postDetail"]->tagline!!}
                        </div>

                        <div class="ds-timeline-outr">
                            <ul class="timeline">

                                <?php
                                if (count($dataArray["childPostData"]) > 0) {
                                    $a = 0;

                                    foreach ($dataArray["childPostData"] as $key => $val) {
                                        ?>
                                        <li class="<?php echo $a % 2 == 0 ? 'timeline-inverted' : ''; ?> phonegap-li">
                                            <div class="timeline-badge"><i class="glyphicon glyphicon-credit-card"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-image"><i class="fa fa-android"></i></div>
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">{{$val->title}}</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>{{substr($val->short_description,0,100)}}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                        $a++;
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="ds-first-btn-outer"> <a href="{{url('contact-us')}}">Request Free Consultation</a> </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ds-mo-app-service" id="app-services">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="heading-two">
                        <h2>{{$dataArray["postDetail"]->title}}</h2>
                    </div>
                </div>
            </div>
            <div id="parentHorizontalTab" class="ds-tabs-main-outer">
                <ul class="resp-tabs-list main-tab-list hor_1">
                    <?php foreach ($dataArray["childPostData"] as $key => $val) { ?>
                    <li><div class="tab-wrap"><div class="tab-li tabTab_{{$key}}"><span><i class="fa fa-image"></i></span>{{$val->title}}</div><div class="overlay"><img src="{{url('images/iphone-tab-img.jpg')}}" alt="img"/></div></div></li>
                    <?php } ?>

                </ul>
                <div class="resp-tabs-container tabs-custom-body-outer hor_1">
                    
                     <?php foreach ($dataArray["childPostData"] as $key => $val) { ?> 
                    <div class="ds-tabs-inner">
                        <h3>{{$val->title}}</h3>
                        <p>{!!$val->short_description!!}</p>
                    </div>
                    <?php } ?>
                    
<!--                    <div class="ds-tabs-inner ds-web-app-tab-outer">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-5 tab-web-app-first-left">
                                <h3>iPhone &amp; iPad Applications</h3>
                                <p>With a talented team of developers, Deftsoft provides you with magnificent mobile applications for both, iPhone and iPad.</p>
                                <a href="service-web-development.html" class="read-more">Read More</a>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-7 tab-web-app-first-right">
                                <div class="tab-web-app-first-right-inner">
                                    <figure><img src="{{url('images/service-img.jpg')}}" alt="" /></figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ds-tabs-inner">
                        <h3>Android &amp; tab apps</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident</p>
                    </div>
                    <div class="ds-tabs-inner">
                        <h3>Hybrid Applications</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident</p>
                    </div>
                    <div class="ds-tabs-inner">
                        <h3>Windows Applications</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident</p>
                    </div>
                    <div class="ds-tabs-inner">
                        <h3>Web Applications</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident</p>
                    </div>
                    <div class="ds-tabs-inner">
                        <h3>Phonegap</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident</p>
                    </div>                -->
                </div>
            </div>
        </div>
        @include('front.testinomial-section');
    </section>

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


            $('.owl-carousel').owlCarousel({
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
    </script>
    <style>
        .category_list .selectedCategory{color:#1a80cc;font-size: 18px; font-weight: bold }
    </style>
    @endsection
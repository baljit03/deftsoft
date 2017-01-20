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
    <section class="ds-tc-service ds-service-indivisual" id="tc-services">
        <div class="ds-tc-service-hdd">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 tc-main-wrap">
                        <div class="title-head">
                            <h5>{!!$dataArray['postDetail']->tagline!!}</h5>
                        </div>


                        <div id="parentHorizontalTab" class="ds-tabs-main-outer service-tabs">
                            <ul class="resp-tabs-list main-tab-list hor_1">
                                <?php
                                $v = 1;

                                foreach ($dataArray["childPostData"] as $key => $val) {
                                    if ($v < 5) {
                                        ?>
                                        <li id="tab<?php echo $v; ?>" class="tab">
                                            <div class="tab-wrap">
                                                <div class="tab-li service-tab<?php echo $v; ?>">
                                                    <span><i class="fa fa-image"></i></span><?php echo $val->title ?></div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    $v++;
                                }
                                ?>



                            </ul>

                            <div class="resp-tabs-container tabs-custom-body-outer hor_1">
                                <?php
                                $v = 1;
                                foreach ($dataArray["childPostData"] as $key => $val) {
                                    if ($v < 5) {
                                        ?>
                                        <div class="ds-tabs-inner">
                                            <h3>{!! $val->title!!}</h3>
                                            <?php $small = $val->short_description;?>
                                            <?php // $small = substr($val->short_description, 0, 500);?>
                                            <p>{!!$small !!}</p>
                                        </div>
                                     
                                        <?php
                                    }
                                    $v++;
                                }
                                ?>

                            </div>

                        </div>

                        <div class="ds-first-btn-outer"> <a href="{{url('contact-us')}}">Request Free Consultation</a> </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="service-indivisual-tabs">
        <?php
        $v = 1;
        foreach ($dataArray["childPostData"] as $key => $val) {
            $urlLink = !empty($val->custom_slug)?$val->custom_slug:$val->post_slug;
            if ($v < 5) {
                ?>
                <div id="tab<?php echo $v;?>show" class="tab-content">
                    <div class="about-inner-bx-outer">
                        <div class="container">
                            <h3 class="service-title"><span>{!! $val->title!!}</span></h3>
                            <div class="tab-left-content">
                                <h3>{!! $val->title1!!}</h3> 
                                <p>{!! $val->short_description!!}</p>
                                <!--<a class="click-btn" href="{{url('portfolio/'.$urlLink)}}">Read More</a>-->
                                <a class="click-btn" href="javascript:void(0);">Read More</a>
                            </div>
                        </div>
                        <div class="tab-image-wrap"><img src="{{url('uploads/portfolioImg/service-design-img.png')}}"  alt=""/></div>
                    </div>
                </div>

                <?php
            }
            $v++;
        }
        ?>
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

            $(document).ready(function () {
                var $contents = $('.tab-content');
                $contents.slice(1).hide();
                $('.tab').click(function () {
                    var $target = $('#' + this.id + 'show').show();
                    $contents.not($target).hide();
                });
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
        $("#header_menu li").eq(0).addClass('active');
        
    </script>

    @endsection
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
<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
<section class="ds-inner-page-banner">
    <div class="container">
        <div class="ds-banner-inside-content">
            <h1>{{$dataArray['postDetail']->title1}} <br />
                <strong>{{$dataArray['postDetail']->title2}} </strong></h1>
            <p>{!!$dataArray['postDetail']->title3!!} </p>
        </div>
    </div>
</section>
<section class="ds-inner-bg" id="ds-business-partner">
    <div class="ds-inner-hdd">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 ds-inner-wrap">
                    <div class="title-head">
                        <h5>{!!$dataArray['postDetail']->tagline!!}</h5>
                    </div>
                    <div class="ds-inner-main"> 
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 ds-inner-content"> 
                                <div class="client-video-reviews">
                                    <div id="owl-demo1" class="owl-carousel2 owl-theme">

                                        <?php foreach ($dataArray['videoTestimonial'] as $key => $val) { ?>

                                            <div class="item">
                                                <div class="client-video-box">
                                                    <div class="client-video">
                                                        <a href="javascript:void(0);" class="showVideo" data-src="{{$val->videoUrl}}">
                                                            <?php $imgClient = isset($val->client_profilImg) && !empty($val->client_profilImg) ? $val->client_profilImg : 'default-img.png'; ?>
                                                            <img src="{{url('uploads/client-profile-img/300x223_'.$imgClient)}}"  alt=""/>
                                                            <div class="play-icon"><img src="images/video-control.png"  alt=""/></div>
                                                        </a>
                                                    </div>
                                                    <h3>{{$val->client_name}}</h3>
                                                    <p>{{$val->client_address}}</p>
                                                </div>
                                            </div>
                                        <?php } ?>


                                    </div>
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

<section class="project-review" id="ds-reviews">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 review-heading">
                <div class="heading-two">
                    <h2>More <strong>From Clients</strong></h2> 

                </div>
            </div>
            <div class="review-on-project">

                <?php $finalData = $result = $dataArray['videoTestimonial']->merge($dataArray['textTestinomial']);
                ?>

                <div class="review-crousel-container"> 
                    <div id="owl-demo2" class="owl-carousel owl-theme">

                        <?php foreach ($finalData as $key => $val) { ?>
                            <?php $imgClient = isset($val->client_profilImg) && !empty($val->client_profilImg) ? $val->client_profilImg : 'default-img.png'; ?>
                            <?php $projectImg = isset($val->projectImg) && !empty($val->projectImg) ? $val->projectImg : 'default-img.png'; ?>
                            <div class="item">
                                <div class="project-review-box">
                                    <div class="img-project"><a href="{{$val->projectUrl}}"><img src="{{url('uploads/client-project-img/842x372_'.$projectImg)}}"  alt=""/></a></div>
                                    <h3><a href="{{$val->projectUrl}}" target="_blank"><?php echo $val->client_name; ?></a></h3>
                                    <p><?php echo $val->client_address; ?></p>
                                    <div class="client-img"><img src="{{url('uploads/client-profile-img/111x111_'.$imgClient)}}"  alt=""/></div>
                                </div>
                            </div>
                        <?php } ?>





                    </div> 
                </div>  
            </div>                           
        </div>
    </div>
    @include('front.testinomial-section');
</section>

<!--------------------Contact us Div------------------------->

<!--------------------Contact us Div------------------------->

<!------TO set Background image-------->


    <script>


        $("body").on("click", ".showVideo", function () {
            var me = $(this);
            var videoUrl = me.attr("data-src");
             var HTML_TEMP = '<iframe width="420" height="315" src="'+videoUrl+'?autoplay=1"></iframe>';
         
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
       $("#header_menu li").eq(1).addClass('active');
    </script>
    

    @endsection
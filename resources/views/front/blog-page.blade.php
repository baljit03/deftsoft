@extends('front.master')
@section('content')
<?php $finalData = $result = $dataArray['videoTestimonial']->merge($dataArray['textTestinomial']); ?>

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
    <section class="ds-blog-bg" id="ds-blog">
        <div class="ds-blog-hdd">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 ds-blog-wrap">
                        <div class="title-head">
                            <h5>{!!$dataArray["postDetail"]->tagline!!}</h5>
                        </div>

                        <div class="ds-blog-main"> 
                            <div class="row">
                                <div class="col-md-8 col-sm-8 col-xs-12 ds-blog-content"> 
                                    <?php
                                    if (count($dataArray["childPostData"]["blogData"]) > 0) {
                                        foreach ($dataArray["childPostData"]["blogData"] as $key => $val) {
                                            ?>

                                            <article class="post">
                                                <?php
                                                if (!empty($val->blogImg)) {
                                                    $img = $val->blogImg;
                                                } else {
                                                    $img = 'default.png';
                                                }
                                                ?>
                                                <figure class="post-featured-image"><a href="blog-single.html"><img src="{{url('/uploads/blogImg/781x374_'.$img)}}"  alt="blog-img"/></a></figure>
                                                <div class="enrty-meta-bar">
                                                    <div class="entry-meta">
                                                        <span class="by-author"><a href="javascript:;"><i class="fa fa-user"></i> {{$val->firstname}} {{$val->lastname}}</a></span>
                                                        <span class="date"><a href="javascript:;"><i class="fa fa-clock-o"></i> {{date("d F Y",strtotime($val->created_at))}}</a></span>
                                                        <div class="social-post">
                                                            <ul>
                                                                <li class="facebook"><a href="javascript:;"><i class="fa fa-facebook"></i></a></li>
                                                                <li class="twitter"><a href="javascript:;"><i class="fa fa-twitter"></i></a></li>
                                                                <li class="g-plus"><a href="javascript:;"><i class="fa fa-google-plus"></i></a></li>
                                                                <li class="linkedin"><a href="javascript:;"><i class="fa fa-linkedin"></i></a></li>
                                                            </ul>
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="entry-content">
                                                    <h2 class="post-title"><a href="javascript:;">{!!$val->title!!}</a></h2>
                                                    <p>{!!$val->description!!}</p>
                                                </div>
                                                <footer class="entry-footer">
                                                <!--<span class="comment"><a href="javascript:;"><i class="fa fa-comment"></i> 28</a></span>
                                                <span class="wishlist active"><a href="javascript:;"><i class="fa fa-heart"></i> 187</a></span>-->
                                                    <span class="read-all"><a href="{{url('blog/'.$val->blog_slug)}}">Read More</a></span>
                                                </footer>
                                            </article>
                                            <!-- post article End -->
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <p>Data not found!</p>

                                    <?php }
                                    ?>

                                    <!-- post article End -->                          
                                    <?php echo $dataArray["childPostData"]["blogData"]->render(); ?>
                                    <!-- Pagination End --> 

                                </div>   
                                <div class="col-md-4 col-sm-4 col-xs-12 ds-blog-sidebar"> 
                                    <div class="search-box">
                                        <h3 class="widget-title">Search</h3>

                                        <?php
                                        @session_start();
                                        $keyword = isset($_SESSION["keyword"]) && !empty($_SESSION["keyword"]) ? $_SESSION["keyword"] : '';
                                        ?>
                                        <input type="text" id="search_keyword" value="{{$keyword}}" placeholder="Enter Search keywords" >
                                        <input type="submit" id="keyword_search" value="Search">
                                    </div>
                                    <div class="category-box">
                                        <h3 class="widget-title">Categories</h3>
                                        <ul class="category_list">
                                            <?php
                                            @session_start();
                                            $category_id = isset($_SESSION["category_id"]) && !empty($_SESSION["category_id"]) ? $_SESSION["category_id"] : '';
                                            foreach ($dataArray["childPostData"]['blogCategory'] as $key => $val) {
                                                ?>
                                                <li ><a class="category_class  <?php echo $category_id == $val->id ? 'selectedCategory' : ''; ?>   " data-id="{{$val->id}}" href="javascript:void(0);">{{$val->name}} <span class="number">({{$val->blogCount}})</span></a></li>
                                                <?php
                                            }
                                            ?>

                                        </ul>
                                    </div>
                                    <div class="newsletter-box">
                                        <h3 class="widget-title">Newsletter</h3>
                                        <form class="newletter-form">
                                            <input type="text" placeholder="Enter Email id">
                                            <input type="submit" value="Subscribe">
                                        </form>
                                    </div>
                                </div>
                            </div> 
                        </div> 

                    </div>
                </div>
            </div>
        </div>
        @include('front.testinomial-section');
    </section>
    <script>

        /***
         * 
         *category filter
         */
        $("body").on("click", "#keyword_search", function () {

            var value = $("#search_keyword").val();
            var dataString = "keyword=" + value + "&_token={{csrf_token()}}";
            $.ajax({
                url: "blog-keyword-search-session",
                type: "POST",
                data: dataString,
                beforeSend: function (xhr) {
                },
                success: function (data) {
                    window.location.href = '{{url("blog")}}';
                }
            });


        });
        $("body").on("click", ".category_class", function () {

            var me = $(this);
            var category_id = me.attr("data-id");

            var dataString = "category_id=" + category_id + "&_token={{csrf_token()}}";
            $.ajax({
                url: "blog-filter-session",
                type: "POST",
                data: dataString,
                beforeSend: function (xhr) {
                },
                success: function (data) {
                    window.location.href = '{{url("blog")}}';
                }
            });


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
    <style>
        .category_list .selectedCategory{color:#1a80cc;font-size: 18px; font-weight: bold }
    </style>


    @endsection
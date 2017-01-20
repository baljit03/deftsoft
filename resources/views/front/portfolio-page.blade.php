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
    <section class="ds-portfolio-wrap" id="ds-portfolio">
        <div class="ds-portfolio-hdd">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 ds-portfolio-main-wrap">
                        <div class="title-head">
                            <h5>{!!$dataArray['postDetail']->tagline!!}</h5>
                        </div>

                        <div class="ds-portfolio-outer"> 
                            <div class="row">

                                <?php
                                $v = 1;
                                foreach ($dataArray["childPostData"] as $key => $val) {
                                    if ($v < 6) {
                                        ?>
                                        <div class="col-md-6 col-sm-12 col-xs-12 portfolio-box portfolio-box1">
                                            <div class="portfolio-inner-box active">
                                                <h2>{!!$val->title!!}</h2>
                                                <div class="portfolio-item">
                                                    <?php
                                                    $valImg = '';
                                                    if (isset($val->portfolio->portfolioImg) && !empty($val->portfolio->portfolioImg)) {
                                                        $valImg = "512x298_".$val->portfolio->portfolioImg;
                                                    } else {
                                                        $valImg = 'default.png';
                                                    }
                                                    ?>
                                                    <img src="{{url('uploads/portfolioImg/'.$valImg)}}" alt="portfolio img"/>
                                                    <div class="mask">
                                                        <div class="mask-content">
                                                            <p>{!!$val->short_description!!}</p>
                                                            <?php
                                                            if (!empty($val->custom_slug)) {
                                                                $slug = $val->custom_slug;
                                                            } else {
                                                                $slug = $val->post_slug;
                                                            }
                                                            $Pageslug = 'portfolio/' . $slug;
                                                            ?>
                                                            <a href="{{url($Pageslug)}}" class="info">View More</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                        <?php
                                    }
                                    $v++;
                                }
                                ?>
                            </div>  
                        </div> 

                        <!--<div class="ds-first-btn-outer"> <a href="javascript:;">View More</a> </div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $("#header_menu li").eq(2).addClass('active');
    </script>
    @endsection
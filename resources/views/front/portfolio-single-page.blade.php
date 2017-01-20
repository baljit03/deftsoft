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
    <section class="ds-portfolio-single-wrap" id="ds-portfolio">
        <div class="ds-portfolio-single-hdd">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 ds-portfolio-single-main-wrap">
                        <div class="title-head">
                            <h5>{!!$dataArray['postDetail']->tagline!!}</h5>
                        </div>

                        <div class="ds-portfolio-outer"> 
                            <div class="row">

                                <div class="crousal-sec">
                                    <!-- Carousel
                                     ================================================== -->
                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                            <li data-target="#myCarousel" data-slide-to="1"></li>
                                            <li data-target="#myCarousel" data-slide-to="2"></li>
                                        </ol>
                                        <div class="carousel-inner" role="listbox">

                                            <?php
                                            foreach ($dataArray['portfolioData'] as $key => $val) {
                                           
                                            $valImg = '';
                                            if (isset($val->portfolioImg) &&!empty($val->portfolioImg)) {
                                            $valImg = "1058x645_".$val->portfolioImg;
                                            } else {
                                            $valImg = 'default.png';
                                            }
                                            
                                            ?> 
                                            <div class="item <?php echo $key == 0 ? 'active' : ''; ?>">
                                                <a href="{{$val->projectUrl}}" target="_blank">  <img class="first-slide" src="{{url('uploads/portfolioImg/'.$valImg)}}" alt="First slide"></a>
                                            </div>
                                            <?php
                                            }
                                            ?>

                                        </div>
                                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div><!-- /.carousel -->   
                                </div>

                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ds-portfolio-single-content">
        <div class="ds-portfolio-single-inner">
            <div class="container"> <img src="{{url('uploads/portfolioImg/profile-single-img.png')}}"  alt=""/> </div>
        </div>
    </section>
    @endsection
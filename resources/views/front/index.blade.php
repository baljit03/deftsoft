@extends('front.master')
@section('content')
<section class="ds-banner">
    <div class="container">
        <div class="ds-banner-hdd">
            <h1>{{$dataArray["postDetail"]->title1}}<br/>
                <strong>{{$dataArray["postDetail"]->title2}}</strong></h1>
        </div>
        <div class="ds-banner-down">
            <figure><a class="banner-to-services " href="#ds-services"><img src="{{url('images/mouse-down-icon.png')}}" alt="" /></a></figure>
        </div>
    </div>
</section>
<section class="ds-services-outer" id="ds-services">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="ds-heading-first">
                    <h2>Our <strong>Services</strong></h2>
                </div>
            </div>
        </div>
        <div id="parentHorizontalTab" class="ds-tabs-main-outer">
            <ul class="resp-tabs-list main-tab-list hor_1">

                @foreach($dataArray["serviceData"] as $key=>$val)
                <li>{{$val->title}}</li>    
                @endforeach

            </ul>
            <div class="resp-tabs-container tabs-custom-body-outer hor_1">
                @foreach($dataArray["serviceData"] as $key=>$val)

                @if($val->post_slug=='web-app-development')
                <div class="ds-tabs-inner ds-web-app-tab-outer">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-5 tab-web-app-first-left">
                            {!!$val->short_description!!}
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 tab-web-app-first-right">
                            <div class="tab-web-app-first-right-inner">
                                <figure><img src="{{url('uploads/postmetaImg/555x339_'.$val->postDetail["development_icon"]["value"])}}" alt="" /></figure>
                                <div class="tab-web-icon"><img src="{{url('uploads/postmetaImg/48x48_'.$val->postDetail["development_edit_icon"]["value"])}}" alt="" /></div>
                            </div>
                        </div>
                    </div>
                    <div class="ds-first-btn-outer"> <a href="{{url("contact-us")}}">Request Free Consultation</a> </div>
                </div>
                @else 
                <div class="ds-tabs-inner">
                    {!!$val->short_description!!}
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
<section class="ds-our-work-section">
    <div class="ds-our-work-hdd">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                    <div class="heading-two"> 
                        <h2>Our <strong>Work</strong></h2>
                    </div>

                    <h5><strong>{{$dataArray["ourworkPost"][0]->title1}}</strong> {{$dataArray["ourworkPost"][0]->title2}}</h5>
                    <p>{{$dataArray["ourworkPost"][0]->tagline}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="ds-work-pictures">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 no-padding">
                    <div class="work-pic-1 work-pic-all-outer"><a href="{{url('portfolio/website-design')}}"><img src="{{url('uploads/our-work/work-pic-1.jpg')}}" alt="" /></a></div>
                    <div class="work-pic-2 work-pic-all-outer"><a href="{{url('portfolio/website-development')}}"><img src="{{url('uploads/our-work/work-pic-2.jpg')}}" alt="" /></a></div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 no-padding">
                    <div class="work-pic-3 work-pic-all-outer"><a href="{{url('portfolio/professional-services')}}"><img src="{{url('uploads/our-work/work-pic-3.jpg')}}" alt="" /></a></div>
                    <div class="work-pic-4-line">
                        <div class="work-pic-4 work-pic-all-outer"><a href="{{url('portfolio/logo-design')}}"><img src="{{url('uploads/our-work/work-pic-4.jpg')}}" alt="" /></a></div>
                        <div class="work-pic-5 work-pic-all-outer"><a href="{{url('portfolio/mobile-app-service')}}"><img src="{{url('uploads/our-work/work-pic-5.jpg')}}" alt="" /></a></div>
                    </div>
                    <div class="work-pic-6"><a href="{{url('portfolio/logo-design')}}"><img src="{{url('uploads/our-work/work-pic-6.jpg')}}" alt="" /></a></div>
                </div>
            </div>
            <!--            <div class="row">
            
                            @if(count($dataArray["portFolioData"])>0)
            
                            @foreach($dataArray["portFolioData"] as $key=>$val)
            <?php $j = $key + 1; ?>
                            @if($key <= 1)
                            @if($key == 0)
                            <div class="col-xs-12 col-sm-6 col-md-6 no-padding">
                                @endif    
            
                                <div class="work-pic-{{$j}} work-pic-all-outer"><a href="{{$val->post_slug}}"><img src="{{url('uploads/our-work/'.$val->banner)}}" alt="" /></a></div>
                                @if($key==1)               
                            </div>
                            @endif    
                            @endif    
            
            
                            @if($key==2)
                            <div class="col-xs-12 col-sm-6 col-md-6 no-padding">
                                <div class="work-pic-{{$j}} work-pic-all-outer"><a href="{{$val->post_slug}}"><img src="{{url('uploads/our-work/'.$val->banner)}}" alt="" /></a></div>
                                <div class="work-pic-4-line">
                                    @endif
                                    @if($key>2 && $key<5) 
                                    <div class="work-pic-{{$j}} work-pic-all-outer"><a href="{{$val->post_slug}}"><img src="{{url('uploads/our-work/'.$val->banner)}}" alt="" /></a></div>
                                    @endif
            
                                    @if($key==4)
                                </div>
                                @endif
                                @if($key==5) 
                                <div class="work-pic-{{$j}} "><a href="{{$val->post_slug}}"><img src="{{url('uploads/our-work/'.$val->banner)}}" alt="" /></a></div>
                            </div>
            
                            @endif
                            @endforeach
            
                            @endif
            
            
                        </div>-->
        </div>
    </div>
    <div class="container">
        <div class="ds-first-btn-outer"> <a href="{{url('portfolio')}}">View More</a> </div>
    </div>
</section>

@if(count($dataArray["getVideoTestimonial"])>0)
@foreach($dataArray["getVideoTestimonial"] as $key=>$val)
<section class="ds-client-video-section">
    <div class="container">
        <div class="col-md-12 client-video-testimonial">
            <div class="client-main-video-outer">
                <div class="video-box">
                    <iframe allowfullscreen="" src="{{$val->videoUrl}}"></iframe>
                </div>
            </div>

            <div class="video-section-text-outer">
                <div class="video-section-text-inside">
                    <div class="video-text">
                        <h4>{{$val->client_name}}</h4>
                        <p>{{$val->client_address}}</p>
                        <span><a href="{{url('/client')}}">More from Client <img alt="" src="{{url('images/video-btn-arrow.png')}}"></a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach
@endif

<section class="ds-blog-section-outer">
    <div class="container">

        <div class="our-client-logo-outer">
            <ul id="owl-demo1" class="owl-carousel1 owl-theme">


                @if(count($dataArray["getClientLogos"])>0)
                @foreach($dataArray["getClientLogos"] as $key=>$val)
                <li class="item"><a href="javascript:void(0);"><img src="{{url('uploads/client-logo/'.$val->banner)}}" alt="" /></a></li>
                @endforeach
                @endif
            </ul>

        </div>


        <div class="our-blog-inner">
            <div class="heading-two"><h2>Our <strong>Blog</strong></h2></div>
            <div class="view-all-btn"><a href="{{url('blog')}}">View All</a></div>
        </div>

        <div class="blog-slider-outer">


            <div id="owl-demo" class="owl-carousel owl-theme">

                @if(count($dataArray["getBlogs"])>0)
                @foreach($dataArray["getBlogs"] as $key=>$val)
                <?php
                $timestamp = strtotime($val->created_at);
                ?>
                <div class="item">
                    <div class="blog-inner-bx-outer">
                        <div class="blog-main-bx">
                            <div class="left-blog-img-outer">
                                <figure><img src="{{url('uploads/blogImg/272x268_'.$val->blogImg)}}" alt="" /></figure>
                                <ul>
                                    <li>{{date('d', $timestamp)}}</li>
                                    <li>{{date('M', $timestamp)}}</li>
                                </ul>
                            </div>

                            <div class="blog-right-txt">
                                <h3>{!!$val->title!!}</h3>
                                <p>{!!substr($val->description,0,100)!!}</p>
                                <div class="name-time-blog">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>{{ $val->firstname}} {{ $val->lastname}}</a></li>
                                        <li><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> {{date('d M Y', $timestamp)}}</a></li>
                                    </ul>
                                </div>

                                <div class="blog-btns-outer">
                                    <ul>
                                        <li><a href="{{url('blog/'.$val->blog_slug)}}">Read more</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
                @endif



            </div>
        </div>
    </div>
</section>
<!--------------------Contact us Div------------------------->
@include("front.contactus-section")

<!--------------------Contact us Div------------------------->

<!------TO set Background image-------->
<style>
    .ds-banner {
        background: rgba(0, 0, 0, 0) url(../uploads/bannerImg/1600x654_{{$dataArray["postDetail"]->banner}}) repeat scroll 0 0;
        background-size: cover;	
        float: left;
        height: 100%;
        margin-top: -100px;
        position: relative;
        width: 100%;
        }
    </style>
    @endsection
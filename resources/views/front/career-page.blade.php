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
    <section class="ds-inner-bg" id="ds-career">
        <div class="ds-inner-hdd">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 ds-inner-wrap">
                        <div class="title-head">
                            <h5><strong>Career </strong>Opportunities</h5>
                            <p> With Deftsoft Informatics we can make you realize your dream. We CARE…. It is our responsibility to take care about the career and Aim of our team with the alignment of Deftsoft Informatics Goals, Aim and Dreams!!!!</p>
                        </div>

                        <div class="ds-inner-main"> 
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 ds-inner-content"> 
                                    <article class="career-content-box">
                                        <figure class="featured-image"><img src="images/career-img.jpg"  alt="career-img"/></figure>
                                        <div class="content-box">
                                            <h2 class="post-title">Life @ deftsoft</h2>
                                            <p>It is not just work that we cultivate, each day we live is a special way of life because at Deftsoft we know just how to do it!<br>
                                                For creativity is the source to innovation and brilliance we ensure that our think tanks at work never run out of that creative essence; we do so by celebrating life and every color that it has to offer! <br>
                                                Rejoicing the festivity of diverse cultures is what makes us family….periodic activities such as marathons and carom championship along with team outings helps keep us pepped up in life and high spirited to be true to our professional commitments. </p>
                                            <a href="javascript:;" class="btn-primary gallary-button">VIEW OUR GALLERY</a>
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

    <section class="ds-mo-app-service ds-current-job" id="app-services">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="heading-two">
                        <h2>Current <strong>Job Openings</strong></h2> 
                    </div>

                </div>
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

            <div id="parentHorizontalTab" class="ds-tabs-main-outer">
                <ul class="resp-tabs-list main-tab-list hor_1">
                    <li><div class="tab-wrap"><div class="tab-li php-tab"><span><i class="fa fa-image"></i></span>PHP<br> DEVELOPEMENT</div><div class="overlay"><img src="images/iphone-tab-img.jpg" alt="img"/></div></div></li>
                    <li><div class="tab-wrap"><div class="tab-li dot-net-tab"><span><i class="fa fa-image"></i></span>DOT NET<br> DEVELOPEMENT</div><div class="overlay"><img src="images/iphone-tab-img.jpg" alt="img"/></div></div></li>
                    <li><div class="tab-wrap"><div class="tab-li mobile-tab"><span><i class="fa fa-image"></i></span>MOBILE<br> DEVELOPEMENT</div><div class="overlay"><img src="images/iphone-tab-img.jpg" alt="img"/></div></div></li>
                    <li><div class="tab-wrap"><div class="tab-li internet-tab"><span><i class="fa fa-image"></i></span>INTERNET<br> MARKETING</div><div class="overlay"><img src="images/iphone-tab-img.jpg" alt="img"/></div></div></li>
                    <li><div class="tab-wrap"><div class="tab-li web-design-tab"><span><i class="fa fa-image"></i></span>WEB<br> DESIGNING</div><div class="overlay"><img src="images/iphone-tab-img.jpg" alt="img"/></div></div></li>
                    <li><div class="tab-wrap"><div class="tab-li business-tab"><span><i class="fa fa-image"></i></span>BUSINESS<br> Development</div><div class="overlay"><img src="images/iphone-tab-img.jpg" alt="img"/></div></div></li>
                    <li><div class="tab-wrap"><div class="tab-li quality-tab"><span><i class="fa fa-image"></i></span>QUALITY<br> ANALYST</div><div class="overlay"><img src="images/iphone-tab-img.jpg" alt="img"/></div></div></li>        
                </ul>
                <div class="resp-tabs-container tabs-custom-body-outer hor_1">
                    <div class="ds-tabs-inner php-tab">
                        <!----------------Accordian------------------------------>

                        <div class="col-md-12">
                            <div class="panel-group" id="accordion">

                                <div class="panel panel-default">
                                    <?php
                                    $v = 0;
                                    if (count($dataArray["childPostData"]["openingData"]["PHP"]->jobs) > 0) {
                                        foreach ($dataArray["childPostData"]["openingData"]["PHP"]->jobs as $key => $val) {
                                            ?>	
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#php_{{$key}}"><span class="glyphicon glyphicon-file pull-right">
                                                        </span>{{$val->job_title}}</a>
                                                </h4>
                                            </div>
                                            <div id="php_{{$key}}" class="panel-collapse collapse <?php echo $v == 0 ? 'in' : ''; ?>">
                                                <ul class="job-cat-1">
                                                    <li class="col-md-4 col-sm-4 col-xs-6">
                                                        <div class="job-content">
                                                            <figure>
                                                                <img src="images/bag-img.png" alt=""/>
                                                            </figure>
                                                            <h3>Job Title:</h3>
                                                            <p>Php Team Lead</p>
                                                        </div>
                                                    </li>
                                                    <li class="col-md-4 col-sm-4 col-xs-6">
                                                        <div class="job-content">
                                                            <figure>
                                                                <img src="images/bag-img.png" alt=""/>
                                                            </figure>
                                                            <h3>Job CATEGORY:</h3>
                                                            <p>{{$val->job_title}}</p>
                                                        </div>
                                                    </li>
                                                    <li class="col-md-4 col-sm-4 col-xs-6">
                                                        <div class="job-content">
                                                            <figure>
                                                                <img src="images/bag-img.png" alt=""/>
                                                            </figure>
                                                            <h3>EXPERIENCE REQUIRED:</h3>
                                                            <p>{{$val->exp_required}}</p>
                                                        </div>
                                                    </li> 
                                                    <li class="col-md-4 col-sm-4 col-xs-6">
                                                        <div class="job-content">
                                                            <figure>
                                                                <img src="images/bag-img.png" alt=""/>
                                                            </figure>
                                                            <h3>JOB LOCATION:</h3>
                                                            <p>{{$val->job_location}}</p>
                                                        </div>
                                                    </li>
                                                    <li class="col-md-4 col-sm-4 col-xs-6">
                                                        <div class="job-content">
                                                            <figure>
                                                                <img src="images/bag-img.png" alt=""/>
                                                            </figure>
                                                            <h3>Job SUMMARY:</h3>
                                                            <p>{!!$val->job_summary!!}</p>
                                                        </div>
                                                    </li>
                                                    <li class="col-md-4 col-sm-4 col-xs-6">
                                                        <div class="job-content">
                                                            <figure>
                                                                <img src="images/bag-img.png" alt=""/>
                                                            </figure>
                                                            <h3>Professional Education</h3>
                                                            <p>{{$val->profession_exp}}</p>
                                                        </div>
                                                    </li>
                                                    <li class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="job-content">
                                                            <figure>
                                                                <img src="images/bag-img.png" alt=""/>
                                                            </figure>
                                                            <h3>SKILLS REQUIRED:</h3>
                                                            <p>{!!$val->skills!!}</p>
                                                        </div>
                                                    </li>                                                     
                                                </ul>
                                                <div class="ds-first-btn-outer margin-top-15"> <a href="javascript:void(0);" class="applyForJob" data-jobid ="{{$val->id}}" >Apply Now!</a> </div>	 
                                            </div> 

                                            <?php
                                            $v++;
                                        }
                                    } else {
                                        ?>
                                        <p>No Job Found!</p>
                                        <?php
                                    }
                                    ?>			
                                </div>
                            </div>
                        </div>


                        <!----------------Accordian------------------------------>
                    </div>



                    <div class="ds-tabs-inner dot-net-tab">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-group" id="accordion1">

                                        <div class="panel panel-default">
                                            <?php
                                            $v = 0;
                                            if (count($dataArray["childPostData"]["openingData"]["DOT NET"]->jobs) > 0) {
                                                foreach ($dataArray["childPostData"]["openingData"]["DOT NET"]->jobs as $key => $val) {
                                                    ?>	
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion1" href="#DOT_NET{{$key}}"><span class="glyphicon glyphicon-file">
                                                                </span>{{$val->job_title}}</a>
                                                        </h4>
                                                    </div>
                                                    <div id="DOT_NET{{$key}}" class="panel-collapse collapse <?php echo $v == 0 ? 'in' : ''; ?>">
                                                        <ul class="job-cat-1">
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job Title:</h3>
                                                                <p>Php Team Lead</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job CATEGORY:</h3>
                                                                <p>{{$val->job_title}}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>EXPERIENCE REQUIRED:</h3>
                                                                <p>{{$val->exp_required}}</p>
                                                            </li> 
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>JOB LOCATION:</h3>
                                                                <p>{{$val->job_location}}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job SUMMARY:</h3>
                                                                <p>{!!$val->job_summary!!}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Professional Education</h3>
                                                                <p>{{$val->profession_exp}}</p>
                                                            </li>
                                                            <li class="col-md-12 col-sm-12 col-xs-12">
                                                                <h3>SKILLS REQUIRED:</h3>
                                                                {!!$val->skills!!}
                                                            </li>                                                     
                                                        </ul>
                                                        <div class="ds-first-btn-outer"> <a href="javascript:void(0);" class="applyForJob" data-jobid ="{{$val->id}}" >Apply Now!</a> </div>	 
                                                    </div> 

                                                    <?php
                                                    $v++;
                                                }
                                            } else {
                                                ?>
                                                <p>No Job Found!</p>
                                                <?php
                                            }
                                            ?>			
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ds-tabs-inner mobile-tab">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-group" id="accordion2">

                                        <div class="panel panel-default">
                                            <?php
                                            $v = 0;
                                            if (count($dataArray["childPostData"]["openingData"]["MOBILE DEVELOPMENT"]->jobs) > 0) {
                                                foreach ($dataArray["childPostData"]["openingData"]["MOBILE DEVELOPMENT"]->jobs as $key => $val) {
                                                    ?>	
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion2" href="#MOBILE_DEVELOPMENT{{$key}}"><span class="glyphicon glyphicon-file">
                                                                </span>{{$val->job_title}}</a>
                                                        </h4>
                                                    </div>
                                                    <div id="MOBILE_DEVELOPMENT{{$key}}" class="panel-collapse collapse <?php echo $v == 0 ? 'in' : ''; ?>">
                                                        <ul class="job-cat-1">
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job Title:</h3>
                                                                <p>Php Team Lead</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job CATEGORY:</h3>
                                                                <p>{{$val->job_title}}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>EXPERIENCE REQUIRED:</h3>
                                                                <p>{{$val->exp_required}}</p>
                                                            </li> 
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>JOB LOCATION:</h3>
                                                                <p>{{$val->job_location}}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job SUMMARY:</h3>
                                                                <p>{!!$val->job_summary!!}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Professional Education</h3>
                                                                <p>{{$val->profession_exp}}</p>
                                                            </li>
                                                            <li class="col-md-12 col-sm-12 col-xs-12">
                                                                <h3>SKILLS REQUIRED:</h3>
                                                                {!!$val->skills!!}
                                                            </li>                                                     
                                                        </ul>
                                                        <div class="ds-first-btn-outer"> <a href="javascript:void(0);" class="applyForJob" data-jobid ="{{$val->id}}" >Apply Now!</a> </div>	 
                                                    </div> 

                                                    <?php
                                                    $v++;
                                                }
                                            } else {
                                                ?>

                                                <p>No Result Found!</p>            
                                                <?php
                                            }
                                            ?>			
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ds-tabs-inner internet-tab">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-group" id="accordion3">

                                        <div class="panel panel-default">
                                            <?php
                                            $v = 0;
                                            if (count($dataArray["childPostData"]["openingData"]["INTERNET MARKETING"]->jobs) > 0) {
                                                foreach ($dataArray["childPostData"]["openingData"]["INTERNET MARKETING"]->jobs as $key => $val) {
                                                    ?>	
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion3" href="#INTERNET_MARKETING{{$key}}"><span class="glyphicon glyphicon-file">
                                                                </span>{{$val->job_title}}</a>
                                                        </h4>
                                                    </div>
                                                    <div id="INTERNET_MARKETING{{$key}}" class="panel-collapse collapse <?php echo $v == 0 ? 'in' : ''; ?>">
                                                        <ul class="job-cat-1">
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job Title:</h3>
                                                                <p>Php Team Lead</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job CATEGORY:</h3>
                                                                <p>{{$val->job_title}}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>EXPERIENCE REQUIRED:</h3>
                                                                <p>{{$val->exp_required}}</p>
                                                            </li> 
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>JOB LOCATION:</h3>
                                                                <p>{{$val->job_location}}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job SUMMARY:</h3>
                                                                <p>{!!$val->job_summary!!}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Professional Education</h3>
                                                                <p>{{$val->profession_exp}}</p>
                                                            </li>
                                                            <li class="col-md-12 col-sm-12 col-xs-12">
                                                                <h3>SKILLS REQUIRED:</h3>
                                                                {!!$val->skills!!}
                                                            </li>                                                     
                                                        </ul>
                                                        <div class="ds-first-btn-outer"> <a href="javascript:void(0);" class="applyForJob" data-jobid ="{{$val->id}}" >Apply Now!</a> </div>	 
                                                    </div> 

                                                    <?php
                                                    $v++;
                                                }
                                            } else {
                                                ?>

                                                <p>No Result Found!</p>            
                                                <?php
                                            }
                                            ?>					
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ds-tabs-inner web-tab">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-group" id="accordion4">

                                        <div class="panel panel-default">
                                            <?php
                                            $v = 0;
                                            if (count($dataArray["childPostData"]["openingData"]["WEB DESIGNING"]->jobs) > 0) {
                                                foreach ($dataArray["childPostData"]["openingData"]["WEB DESIGNING"]->jobs as $key => $val) {
                                                    ?>	
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion4" href="#WEB_DESIGNING{{$key}}"><span class="glyphicon glyphicon-file">
                                                                </span>{{$val->job_title}}</a>
                                                        </h4>
                                                    </div>
                                                    <div id="WEB_DESIGNING{{$key}}" class="panel-collapse collapse <?php echo $v == 0 ? 'in' : ''; ?>">
                                                        <ul class="job-cat-1">
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job Title:</h3>
                                                                <p>Php Team Lead</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job CATEGORY:</h3>
                                                                <p>{{$val->job_title}}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>EXPERIENCE REQUIRED:</h3>
                                                                <p>{{$val->exp_required}}</p>
                                                            </li> 
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>JOB LOCATION:</h3>
                                                                <p>{{$val->job_location}}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job SUMMARY:</h3>
                                                                <p>{!!$val->job_summary!!}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Professional Education</h3>
                                                                <p>{{$val->profession_exp}}</p>
                                                            </li>
                                                            <li class="col-md-12 col-sm-12 col-xs-12">
                                                                <h3>SKILLS REQUIRED:</h3>
                                                                {!!$val->skills!!}
                                                            </li>                                                     
                                                        </ul>
                                                        <div class="ds-first-btn-outer"> <a href="javascript:void(0);" class="applyForJob" data-jobid ="{{$val->id}}" >Apply Now!</a> </div>	 
                                                    </div> 

                                                    <?php
                                                    $v++;
                                                }
                                            } else {
                                                ?>

                                                <p>No Result Found!</p>  
                                                <?php
                                            }
                                            ?>			
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ds-tabs-inner business-tab">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-group" id="accordion5">

                                        <div class="panel panel-default">
                                            <?php
                                            $v = 0;
                                            if (count($dataArray["childPostData"]["openingData"]["BUSINESS DEVELOPMENT"]->jobs) > 0) {
                                                foreach ($dataArray["childPostData"]["openingData"]["BUSINESS DEVELOPMENT"]->jobs as $key => $val) {
                                                    ?>	
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion5" href="#BUSINESS_DEVELOPMENT{{$key}}"><span class="glyphicon glyphicon-file">
                                                                </span>{{$val->job_title}}</a>
                                                        </h4>
                                                    </div>
                                                    <div id="BUSINESS_DEVELOPMENT{{$key}}" class="panel-collapse collapse <?php echo $v == 0 ? 'in' : ''; ?>">
                                                        <ul class="job-cat-1">
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job Title:</h3>
                                                                <p>Php Team Lead</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job CATEGORY:</h3>
                                                                <p>{{$val->job_title}}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>EXPERIENCE REQUIRED:</h3>
                                                                <p>{{$val->exp_required}}</p>
                                                            </li> 
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>JOB LOCATION:</h3>
                                                                <p>{{$val->job_location}}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job SUMMARY:</h3>
                                                                <p>{!!$val->job_summary!!}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Professional Education</h3>
                                                                <p>{{$val->profession_exp}}</p>
                                                            </li>
                                                            <li class="col-md-12 col-sm-12 col-xs-12">
                                                                <h3>SKILLS REQUIRED:</h3>
                                                                {!!$val->skills!!}
                                                            </li>                                                     
                                                        </ul>
                                                        <div class="ds-first-btn-outer"> <a href="javascript:void(0);" class="applyForJob" data-jobid ="{{$val->id}}" >Apply Now!</a> </div>	 
                                                    </div> 

                                                    <?php
                                                    $v++;
                                                }
                                            } else {
                                                ?>
                                                <p>No Result Found!</p>  
                                            <?php } ?>			
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="ds-tabs-inner quality-tab">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-group" id="accordion6">

                                        <div class="panel panel-default">
                                            <?php
                                            $v = 0;
                                            if (count($dataArray["childPostData"]["openingData"]["QUALITY ANALYST"]->jobs) > 0) {
                                                foreach ($dataArray["childPostData"]["openingData"]["QUALITY ANALYST"]->jobs as $key => $val) {
                                                    ?>	
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion6" href="#QUALITY_ANALYST{{$key}}"><span class="glyphicon glyphicon-file">
                                                                </span>{{$val->job_title}}</a>
                                                        </h4>
                                                    </div>
                                                    <div id="php_{{$key}}" class="panel-collapse collapse <?php echo $v == 0 ? 'in' : ''; ?>">
                                                        <ul class="job-cat-1">
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job Title:</h3>
                                                                <p>Php Team Lead</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job CATEGORY:</h3>
                                                                <p>{{$val->job_title}}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>EXPERIENCE REQUIRED:</h3>
                                                                <p>{{$val->exp_required}}</p>
                                                            </li> 
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>JOB LOCATION:</h3>
                                                                <p>{{$val->job_location}}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Job SUMMARY:</h3>
                                                                <p>{!!$val->job_summary!!}</p>
                                                            </li>
                                                            <li class="col-md-4 col-sm-4 col-xs-6">
                                                                <h3>Professional Education</h3>
                                                                <p>{{$val->profession_exp}}</p>
                                                            </li>
                                                            <li class="col-md-12 col-sm-12 col-xs-12">
                                                                <h3>SKILLS REQUIRED:</h3>
                                                                {!!$val->skills!!}
                                                            </li>                                                     
                                                        </ul>
                                                        <div class="ds-first-btn-outer"> <a href="javascript:void(0);" class="applyForJob" data-jobid ="{{$val->id}}" >Apply Now!</a> </div>	 
                                                    </div> 

                                                    <?php
                                                    $v++;
                                                }
                                            } else {
                                                ?>
                                                <p>No Result Found!</p>  
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
                width: 'auto', //auto or any width like 600px                 fit: true, // 100% fit in a container
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
                    }, 600: {
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


        $("body").on("click", ".applyForJob", function () {
            var me = $(this);
            var index = $(".applyForJob").index(me);
            var value = me.attr("data-jobid");

            var HTML_TEMP = '<form action="job-application" name="jobApplication" id="jobApplication" method="POST" enctype="multipart/form-data">';
            HTML_TEMP += 'Name : <input type="text" name="job_person_name"/><br/>';
            HTML_TEMP += 'Email : <input type="text" name="job_person_email"/><br/>';
            HTML_TEMP += 'Phone Number : <input type="text" name="job_person_phone"/><br/>';
            HTML_TEMP += 'Upload Resume : <input accept=".csv,.pdf,.docx,.doc,.txt" type="file" name="job_person_resume"/><br/>';
            HTML_TEMP += '<input type="hidden" value="{{csrf_token()}}" name="_token"/>';
            HTML_TEMP += '<input type="hidden" value="' + value + '" name="job_id"/>';
            HTML_TEMP += '<div>Please Validate the following expersion:</div><div class="rand1"></div>';
            HTML_TEMP += '<div>+</div><div class="rand2"></div><a href="javascript:void(0);" onclick="randomnum();">Refresh</a>';
            HTML_TEMP += '<p id="capcha_message"></p><input type="text" id="total" autocomplete="off"  />';

            HTML_TEMP += '<input type="submit" id="jobApplicationBtn" class="btn btn-primary" value="Apply"/>';
            HTML_TEMP += '</form>';

            $("#mainpopup").show();
            $("#mainpopup_content").html(HTML_TEMP);
            randomnum();
        });
        $("body").on("click", "#jobApplicationBtn", function () {
            jQuery.validator.addMethod("nameCustom", function (value, element) {
                return this.optional(element) || /^[a-zA-Z'\s]+$/i.test(value);

            }, "Please Fill Correct Value in Field.");
            jQuery.validator.addMethod("messageCustom", function (value, element) {
                return this.optional(element) || /^[a-zA-Z0-9'\s]+$/i.test(value);

            }, "Please Fill Correct Value in Field.");

            $("body #jobApplication").validate({
                rules: {
                    job_person_name: {
                        required: true,
                        nameCustom: true,
                        maxlength: 20
                    },
                    job_person_email: {
                        required: true,
                        email: true
                    },
                    job_person_phone: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 12
                    },
                    job_person_resume: {
                        required: true
                    }

                },
                messages: {
                    job_person_name: {
                        required: "Please enter name",
                        nameCustom: "Please enter vaild name",
                        maxlength: "name allows only 20 characters "
                    },
                    job_person_email: {
                        required: "Please enter email",
                        email: "Please enter vaild email"
                    },
                    job_person_phone: {
                        required: "Please enter phone number",
                        number: "Please enter vaild phone number",
                        minlength: "Please enter vaild phone number",
                        maxlength: "Please enter vaild phone number"
                    },
                    job_person_resume: {
                        required: "Please select resume"
                    }
                },
                submitHandler: function (form) {
                    var total = parseInt($('.rand1').html()) + parseInt($('.rand2').html());
                    var total1 = $('#total').val();
                    if (total1 == '') {
                        $("#capcha_message").html("<span style='color:red'>Please validate capcha!</span>");
                        return false;
                    }
                    if (total != total1)
                    {
                        $("#capcha_message").html("<span style='color:red'>wrong capcha!</span>");
                        randomnum();
                        return false;
                    }
                    else
                    {
                        $("#capcha_message").html("<span style='color:green'>Validate!</span>");
                    }
                    form.submit();
                }
            });
        });
    </script>
    <style>.form-inline .form-group { margin-right:10px; }
        .well-primary {
            color: rgb(255, 255, 255);
            background-color: rgb(66, 139, 202);
            border-color: rgb(53, 126, 189);
        }
        .glyphicon { margin-right:5px; }</style>

    <style type="text/css">
        .rand1, .rand2
        {
            padding: 16px;
            background-color: #ADDB4B;
            margin: 25px 0;
            float: left;
            border-radius: 49px;
        }
        .plus
        {
            padding: 16px 0;
            margin: 25px 7px;
            float: left;
        }
        .re
        {
            padding:8px;
            background-color:#D8A217;
            margin:35px;
            float:left; cursor:pointer;
            box-shadow: 2px 2px 2px 1px #818181;
            -moz-box-shadow: 2px 2px 2px 1px #818181;
            -webkit-box-shadow: 2px 2px 2px 1px #818181;
            -ms-box-shadow: 2px 2px 2px 1px #818181;
            -o-box-shadow: 2px 2px 2px 1px #818181;
        }

        #total
        {
            margin:35px;
            height:30px;
            width:50px;
        }

    </style>
    <script>
        $(document).ready(function () {
            randomnum();
        });
        function randomnum()
        {
            var number1 = 5;
            var number2 = 50;
            var randomnum = (parseInt(number2) - parseInt(number1)) + 1;
            var rand1 = Math.floor(Math.random() * randomnum) + parseInt(number1);
            var rand2 = Math.floor(Math.random() * randomnum) + parseInt(number1);
            $(".rand1").html(rand1);
            $(".rand2").html(rand2);
        }
    </script>

    @endsection
<!-- testimonal section start -->
<section class="ds-testimonal-section">
    <div class="ds-testimonal-hdd">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12"> 
                    <div class="about-testimonal-outr">
                        <div class="testimonal-icon"> 
                            <div class="testi-icon-box"><i class="fa fa-quote-left" aria-hidden="true"></i></div>
                        </div>
                        <div id="owl-demo" class="owl-carousel owl-theme">

                            <?php foreach ($finalData as $key => $val) {
                                ?>
                                <div class="item">
                                    <div class="about-inner-bx-outer">
                                        <h3>{{$val->client_name}}</h3>
                                        <p> {{strip_tags(trim($val->feedbacks))}} </p>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div> 
                </div>
            </div> 
        </div>
    </div>
</section>

<section class="ds-reach-out-section">
    <div class="ds-reach-out-hdd">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="heading-two">
                        <h2><strong>Reach</strong> Out</h2>
                    </div>
                    <h5> We will be glad to <strong>hear from you. </strong></h5>

                    <a href="{{url('contact-us')}}" class="click-btn">Click to Connect </a>
                </div>
            </div>
        </div>
    </div>
</section>

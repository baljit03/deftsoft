
<div class="partners-outer">
    <div class="container">
        <ul>
            @foreach($systemData["partnersData"] as $key => $val)

            <li><a href="#"><img src="{{url('uploads/partnerImg/'.$val->banner)}}" alt="" /></a></li>
            @endforeach
        </ul>
    </div>
</div>
<footer class="footer">
    <div class="ds-first-footer-outer">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-3 ftr-link-first">
                    <ul>
                        @if(count($systemData["footerMenu"]["first_section"])>0)
                        @foreach($systemData["footerMenu"]["first_section"] as $key => $val)
                        @if($key==0)
                        <h4>{{$val['parentPostDetail']->title}}</h4>
                        @endif
                        <li><a href="{{url($val['portfolio_link'])}}">{{$val['name']}}</a></li>
                        @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3 ftr-link-second">
                    @if(count($systemData["footerMenu"]["second_section"])>0)
                    @foreach($systemData["footerMenu"]["second_section"] as $key => $val)
                    @if($key==0)
                    <h4>{{$val['parentPostDetail']->title}}</h4>
                    <ul>
                        @endif
                        <li><a href="{{url($val['portfolio_link'])}}">{{$val['name']}}</a></li>
                        @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3 ftr-link-third">
                    @if(count($systemData["footerMenu"]["third_section"])>0)
                    @foreach($systemData["footerMenu"]["third_section"] as $key => $val)
                    @if($key==0)
                    <h4>{{$val['parentPostDetail']->title}}</h4>
                    <ul>
                        @endif
                        <li><a href="{{url($val['portfolio_link'])}}">{{$val['name']}}</a></li>
                        @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3 ftr-link-forth">
                    @if(count($systemData["footerMenu"]["fourth_section"])>0)
                    @foreach($systemData["footerMenu"]["fourth_section"] as $key => $val)

                    @if($key==0)
                    <h4>{{$val['section_title']}}</h4>
                    <ul>
                        @endif
                        <li><a href="<?php echo!empty($val['postDetail']->post_slug) ? $val['postDetail']->post_slug : 'javascript:void(0);' ?>">{{$val['name']}}</a></li>
                        @endforeach
                        @endif
                    </ul>
                    <div class="ds-signup-newslter-outer">
                        <h4>Sign Up Our Newsletter</h4>
                        <div class="newsletter-inner">
                            <form>
                                <input type="email"  required onblur="if (this.value == '')
                                            this.value = 'Enter Your Email';" onfocus="if (this.value == 'Enter Your Email')
                                                        this.value = '';" value="Enter Your Email" name="email" />
                                <span class="newslter-submit"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ds-second-footer-outer">
        <div class="container">
            <div class="ds-footer-social-icons">
                <ul>
                    <li class="ds-fb-icon"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li class="ds-twt-icon"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li class="ds-google-icon"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                    <li class="ds-link-icon"><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                </ul>
            </div>
            <p>© Copyright <?php echo $systemData["systemConfig"]["copyright_year"]["value"]; ?> <strong><a href="<?php echo $systemData["systemConfig"]["copyright_by_link"]["value"]; ?>"><?php echo $systemData["systemConfig"]["copyright_by"]["value"]; ?></a></strong> (P) Ltd. All Rights Reserved.</p>
        </div>
    </div>
</footer>
<p id="back-top">
    <a href="#top"><span><i class="fa fa-angle-up"></i></span></a>
</p>




<div class="popup-outr" id="mainpopup"  style="display:none;"> 
    <div class="popup-inner" >
        <div id="mainpopup_content">
        </div>


        <button class="cross-outr" id="closePopupBtn"> X </button>
    </div>
</div>
<style>
    .popup-outr{width:100%; height:100%; background:rgba(0, 0, 0, 0.8); position:fixed; top:0; right:0; bottom:0; left:0; z-index: 999;}
    .popup-inner {
        background: #ffffff none repeat scroll 0 0;
        margin: 50px auto auto;
        max-width: 480px;
        padding: 30px;
        position: relative;
        text-align: center;
        width: 100%;
    }
    button.cross-outr {background: #ffffff;border: 1px solid #cccccc;border-radius: 100%;color: #000000;height: 30px;
                       position: absolute;right: -14px;top: -15px; width: 30px;}

</style>
<script>
    $("body").on("click", "#closePopupBtn", function () {
        $("#mainpopup").hide();
        $("#mainpopup_content").html('');

    });
</script>
</body>
</html>
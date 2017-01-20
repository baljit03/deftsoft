
<section class="ds-contact-section-outer">
    <div class="container">
        <div class="row ds-contact-hdd">
            <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                <div class="ds-heading-first">
                    <h2>Contact <strong>Us</strong></h2>
                </div>
                <h6>Let's Work Together – To Grow Your Business</h6>
                <p>Fill out the form below and we will be in touch with you within the next 24 hours.</p>
                @if(Session::has('message'))
                <div id="msg_div" class="alert alert-success">
                    <a class="close" data-dismiss="alert">×</a>
                    <strong>Success!</strong> {!!Session::get('message')!!}
                </div>
                <script>
                    $('html,body').animate({scrollTop: $(document).height() * 0.99 - $(window).height()}, 500);
                    setTimeout(function () {
                        $("#msg_div").remove();
                    }, 8000);
                </script>


                @endif
                @if(Session::has('errormessage'))
                <div id="msg_div" class="alert alert-danger">
                    <a class="close" data-dismiss="alert">×</a>
                    <strong>Failed!</strong> {!!Session::get('errormessage')!!}
                </div>
                <script>
                    $('html,body').animate({scrollTop: $(document).height() * 0.99 - $(window).height()}, 500);
                    setTimeout(function () {
                        $("#msg_div").remove();
                    }, 8000);
                </script>


                @endif
            </div>

        </div>
        <form action="{{url('contact-us-submit')}}" name="contact-us" id="contact-us" method="post">
            <div class="row ds-home-contact-form-outer">
                <div class="col-xs-12 col-sm-5 col-md-5">
                    <div class="form-group">
                        <input type="text"  id="name" name="name" maxlength="20" Placeholder="Your Name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" Placeholder="Your Email id"class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="mobile" name="phone_number" maxlength="12"  Placeholder="Phone Number" class="form-control" />
                    </div>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-7">
                    <div class="form-group">
                        <textarea class="form-control" id="message"  name="message_content" placeholder="message" maxlength="1000" rows="7"></textarea>
                        <p>
                            <span>Characters remaining: <span id="rem_post" title="1000">1000</span></span>
                        </p>
                    </div>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    @include('front.capcha-section')
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 ds-submit-btn-outer">
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input class="submit-btn" type="submit" value="Submit" name="Submit" />
                    </div>
                </div>
            </div></form>
    </div>
</section>
<script>
    $("#message").keyup(function () {
        var cmax = 1000;// $("#rem_" + $(this).attr("id")).attr("title");

        if ($(this).val().length >= cmax) {
            $(this).val($(this).val().substr(0, cmax));
        }

        $("#rem_post").text(cmax - $(this).val().length);

    });

    jQuery.validator.addMethod("nameCustom", function (value, element) {
        return this.optional(element) || /^[a-zA-Z'\s]+$/i.test(value);

    }, "Please Fill Correct Value in Field.");
    jQuery.validator.addMethod("messageCustom", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9'\s]+$/i.test(value);

    }, "Please Fill Correct Value in Field.");

    $("body #contact-us").validate({
        rules: {
            name: {
                required: true,
                nameCustom: true,
                maxlength: 20
            },
            phone_number: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 12
            },
            email: {
                required: true,
                email: true
            },
            message_content: {
                required: true,
                messageCustom: true
            }
        },
        messages: {
            name: {
                required: "Please enter name",
                nameCustom: "Please enter vaild name",
                maxlength: "name allows only 20 characters "
            },
            phone_number: {
                required: "Please enter phone number",
                number: "Please enter vaild phone number",
                minlength: "Please enter vaild phone number",
                maxlength: "Please enter vaild phone number"
            },
            email: {
                required: "Please enter email",
                email: "Please enter vaild email"
            },
            message_content: {
                required: "Please enter your message",
                messageCustom: "Please enter alphanumeric data"
            },
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
</script>
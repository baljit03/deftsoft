@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')
@include('admin.ckeditor')
<div id="page-wrapper">
    <?php
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add New Testnomial </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Enter Testimonial Details
                    @if(Session::has('message'))
                    <div id="msg_div" class="alert alert-success">
                        <a class="close" data-dismiss="alert">×</a>
                        <strong>Success!</strong> {!!Session::get('message')!!}
                    </div>
                    <script>
                        setTimeout(function () {
                            $("#msg_div").remove();
                        }, 3000);
                    </script>
                    @endif
                </div> 

                <div class="col-lg-6">
                    <form enctype="multipart/form-data" action="{{url('admin/add-new-testimonial-data')}}" method="post" id="add_testinomail_form" name="add_testinomail_form" class="add_testinomail_form">
                        <!-- /.col-lg-6 (nested) -->
                        <div class="form-group">
                            <label>Client Name</label>
                            <input class="form-control" name="client_name" value="">
                        </div>
                        <div class="form-group">
                            <label>Client Address</label>
                            <input class="form-control" name="client_address" value="">
                        </div>
                        <div class="form-group">
                            <label>Profile Image</label>
                            <input type="file" accept="image/x-png,image/gif,image/jpeg" id="files" name="profie_image"/>
                            <img src=""  id="prevImg" style="display:none" height="150" width="150"/>
                        </div>
                        <div class="form-group">
                            <label>Project Image</label>
                            <input type="file" accept="image/x-png,image/gif,image/jpeg" id="files1" name="project_image"/>
                            <img src=""  id="prevImg1" style="display:none" height="150" width="150"/>
                        </div>

                        <div class="form-group">
                            <label>Feedbacks</label> 
                            <textarea name="feedbacks" id="editor" rows="10" cols="80"></textarea>
                        </div>
                        <div class=" form-group">
                            <label>projectUrl</label> 

                            <input type="text" class="form-control" name="projectUrl" value="">
                        </div>
                        <div class="form-group">
                            <label>Testimonial Type</label>
                            <select name="testimonial_type" class="testimonial_type form-control">
                                <option value="" selected="selected" disabled="disabled">Choose Testimonial Type</option>
                                <option title="text"  value="text">Text</option>
                                <option title="video"  value="video">Video</option>
                            </select>
                        </div>
                        <div class="videoUrlDiv" style="display:none" >
                            <div  class="form-group ">
                                <label>Video Url</label>
                                <input class="form-control" name="videoUrl" value="">
                            </div>
                            
                            </div>


                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="" selected="selected" disabled="disabled">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="deleted">Deleted</option>
                                </select>
                            </div>

                            <input type="hidden" name='_token' value="{{csrf_token()}}"/>    
                            <input type="submit" id="add_testimonail_form_btn" class="btn btn-default" value="Submit Button" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	initSample();
</script>
<script>
 
    $(document).ready(function () {
        $.validator.addMethod("lettersonly", function (value, element) {
            return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Letters only please");
        $("body").on("click", "#add_testimonail_form_btn", function () {
            var me = $(this);
            $("#add_testinomail_form").validate({
                rules: {
                    client_name: {
                        required: true
                    },
                    client_address: {
                        required: true
                    },
                    projectUrl: {
                        url: true
                    },
                    videoUrl: {
                        required: true,
                        url: true
                    },
                    testimonial_type: {
                        required: true
                    },
                    status: {
                        required: true
                    }
                },
                messages: {
                    client_name: {
                        required: "Please enter client name"
                    },
                    client_address: {
                        required: "Please enter address info"
                    },
                    projectUrl: {
                        url: "Please enter vaild url"
                    },
                    videoUrl: {
                        required: "Please enter video url",
                        url: "Please enter vaild url"
                    },
                    testimonial_type: {
                        required: "Please enter testimonial type"
                    },
                    status: {
                        required: "Please select status"
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });

  $("body").on("change", ".testimonial_type", function () {
        var me = $(this);
        var value = me.val();
        if (value == 'video') {
            $(".videoUrlDiv").show();
        } else {
            $(".videoUrlDiv").hide();
        }
    });

    });
    /***
     * 
     *To preview the image
     */
    document.getElementById("files").onchange = function () {
        var reader = new FileReader();

        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            $("#prevImg").show();
            document.getElementById("prevImg").src = e.target.result;
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    };
    /***
     * 
     *To preview the image
     */
    document.getElementById("files1").onchange = function () {
        var reader = new FileReader();

        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            $("#prevImg1").show();
            document.getElementById("prevImg1").src = e.target.result;
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    };
    /***
     * 
     *To preview the image
     */
    document.getElementById("files2").onchange = function () {
        var reader = new FileReader();

        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            $("#prevImg2").show();
            document.getElementById("prevImg2").src = e.target.result;
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    };

  

</script>

@endsection
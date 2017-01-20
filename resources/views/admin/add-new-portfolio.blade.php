@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')
@include('admin.ckeditor')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add New Portfolio</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New Portfolio
                </div> 
                <!-- /.panel-heading -->
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
                <div class="col-lg-6">

                    <form  enctype="multipart/form-data"  name="add_portfolio_form" id="add_portfolio_form" action="{{url('admin/add-portfolio-form')}}" enctype="multipart-form/data" method="post">
                        <!-- /.col-lg-6 (nested) -->
                        <div class="form-group">
                            <label>Portfolio Category</label>
                            <select name="portfolio_category" class="form-control">
                                <option selected="selected" disabled="disabled">Select Category</option>
                                @foreach($dataArray["portfolioData"] as $key=>$val)
                                <option value="{{$val->id}}">{{$val->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" name="portfolio_title" value="">
                        </div>

                        <div class="form-group">
                            <label>Portfolio Image</label>
                            <input type="file" accept="image/x-png,image/gif,image/jpeg" name="portfolioImg" id="files"/>
                            <img   id="prevImg" style="display:none" height="150" width="150"/>
                        </div>
                        <div class="form-group">
                            <label>Project URL:</label>
                            <input class="form-control" type="text" name="projectUrl" id="projectUrl"  />
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="post_status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <input type="submit" class="form_button btn btn-default" value="Submit" />

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
    var k = 0;
    var l = 0;

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

    /*****
     * validate the form
     */



    $("body #add_portfolio_form").validate({
        rules: {
            portfolio_category: {
                required: true
            },
            portfolio_title: {
                required: true
            },
            portfolioImg: {
                required: true
            },
            projectUrl: {
                required: true,
                url: true
            },
            post_status: {
                required: true
            }
        },
        messages: {
            portfolio_category: {
                required: "Please select category"
            },
            portfolio_title: {
                required: "Please enter title"
            },
            portfolioImg: {
                required: "Please select image"
            },
            projectUrl: {
                required: "Please enter url",
                url: "Please enter url"
            },
            post_status: {
                required: "Please select status"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }

    });



    /***
     * To setup the valid metaKey
     */
    $("body").on("blur", '.metaKeyClass', function () {
        var me = $(this);
        var value = me.val();
        var new_val = value.toLowerCase();
        new_val = new_val.replace(/ /g, "_");
        me.val(new_val);
    });
    /***
     * To setup the valid metaKey
     */
    $("body").on("keyup", '#custom_url', function () {
        var me = $(this);
        var value = me.val();
        var new_val = value.toLowerCase();
        new_val = new_val.replace(/ /g, "-");
        me.val(new_val);
    });
    $("body").on("blur", '#custom_url', function () {
        var me = $(this);
        var value = me.val();
        if (value != '') {
            var dataString = "check_url=" + value + "&_token={{csrf_token()}}";
            $.ajax({
                data: dataString,
                url: "custom_url_check",
                type: "POST",
                beforeSend: function (xhr) {

                },
                success: function (data) {
                    $(".url_error").remove();
                    if (data == 'ok') {
                        $("#custom_url").after("<p style='color:green' class='url_error'>Url Available!</p>");
                    } else {
                        $("#custom_url").after("<p style='color:red' class='url_error'>Url Already Exists!</p>");
                        me.focus();
                    }

                }
            });
        } else {
            $(".url_error").remove();
        }

    });


</script>
@endsection
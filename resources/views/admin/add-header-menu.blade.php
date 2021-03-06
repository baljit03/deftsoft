@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')
@include('admin.ckeditor')


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Menu</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Menu
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

                    <form  enctype="multipart/form-data"  name="add_menu_form" id="add_menu_form" action="{{url('admin/add-header-menu-detail')}}" enctype="multipart-form/data" method="post">
                        <!-- /.col-lg-6 (nested) -->
                        <div class="form-group">
                            <label>Menu Name</label>
                            <input class="form-control" name="menu_name" value="">
                        </div>
                        <div class="form-group">
                            <label>Post Category</label>
                            <select name="post_category" id="post_category" class="form-control" >
                                <option selected="selected" disabled="disabled">Select Post Category</option>
                                <?php
                                foreach ($dataArray["pagePost"] as $key => $val) {
                                    ?>
                                    <option value="{{$val->id}}" >{{$val->title}}</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Menu Sort Index</label>
                            <input class="form-control" name="menu_index" value="">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="menu_status">
                                <option value="Active"  >Active</option>
                                <option value="Inactive"  >Inactive</option>
                            </select>
                        </div>
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <input type="submit" class="form_button btn btn-default" value="Submit Button" />
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

    /*****
     * validate the form
     */

//

    $("body #add_menu_form").validate({
        rules: {
            menu_name: {
                required: true
            },
            post_category: {
                required: true
            },
            menu_index: {
                required: true
            } 
        },
        messages: {
            menu_name: {
                required: "Please enter name"
            },
            post_category: {
                required: "Please select category"
            },
            menu_index: {
                required: "Please enter index"
            } 
        },
        submitHandler: function (form) {
            form.submit();
        }

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
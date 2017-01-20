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

                    <form  enctype="multipart/form-data"  name="edit_menu_form" id="edit_menu_form" action="{{url('admin/edit-footer-menu-detail')}}" enctype="multipart-form/data" method="post">
                        <!-- /.col-lg-6 (nested) -->
                        <div class="form-group">
                            <label>Menu Name</label>
                            <input class="form-control" name="menu_name" value="{{$dataArray["footerMenuData"]->name}}">
                        </div>
<!--                        <div class="form-group">
                            <label>Menu Section Title</label>
                            <input class="form-control" name="menu_section_title" value="{{$dataArray["footerMenuData"]->section_title}}">
                        </div>-->
                        <div class="form-group">
                            <label>Parent Menu</label>
                            <select name="post_category" id="post_category" class="form-control" >
                                <option selected="selected" disabled="disabled">Select Post Category</option>
                                <?php
                                foreach ($dataArray["ServicePost"] as $key => $val) {
                                    ?>
                                    <option value="{{$val->id}}"  <?php echo $dataArray["parentServiceDetails"]->id == $val->id ? 'selected="selected"' : ''; ?>  >{{$val->title}}</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Linked Post</label>
                            <select name="linked_post" id="linked_post" class="form-control" >
                                <option selected="selected" disabled="disabled">Select Post</option>
                                <?php
                                foreach ($dataArray["SubServicePost"] as $key => $val) {
                                    ?>
                                    <option value="{{$val->id}}"  <?php echo $dataArray["footerMenuData"]->post_id == $val->id ? 'selected="selected"' : ''; ?>  >{{$val->title}}</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>



                        <div class="form-group">
                            <label>Menu Sort Index</label>
                            <input class="form-control" name="menu_index" value="{{$dataArray["footerMenuData"]->sort_index}}">
                        </div>

                        <div class="form-group">
                            <label>Linked Portfolio</label>
                            <select class="form-control" name="linked_portfolio">
                                <?php
                                foreach ($dataArray["PortfolioPost"] as $key => $val) {
                                    ?>
                                    <option value="{{$val->id}}"  <?php echo $dataArray["footerMenuData"]->portfolio_post_id == $val->id ? 'selected="selected"' : ''; ?>  >{{$val->title}}</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Footer Section</label>
                            <select class="form-control" name="footer_section">
                                <option value="section1"  <?php echo $dataArray["footerMenuData"]->footer_section == 'section1' ? 'selected="selected"' : ''; ?> >Section 1</option>
                                <option value="section2" <?php echo $dataArray["footerMenuData"]->footer_section == 'section2' ? 'selected="selected"' : ''; ?> >Section 2</option>
                                <option value="section3" <?php echo $dataArray["footerMenuData"]->footer_section == 'section3' ? 'selected="selected"' : ''; ?> >Section 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="menu_status">
                                <option value="Active"  <?php echo $dataArray["footerMenuData"]->status == 'Active' ? 'selected="selected"' : ''; ?> >Active</option>
                                <option value="Inactive" <?php echo $dataArray["footerMenuData"]->status == 'Inactive' ? 'selected="selected"' : ''; ?> >Inactive</option>
                            </select>
                        </div>
                        <input type="hidden" name="menuId" value="{{$dataArray["footerMenuData"]->id}}" />
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

    $("body #edit_menu_form").validate({
        rules: {
            menu_name: {
                required: true
            },
            post_category: {
                required: true
            },
            menu_index: {
                required: true
            },
            linked_portfolio: {
                required: true
            },
            footer_section: {
                required: true
            },
            menu_status: {
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
            },
            linked_portfolio: {
                required: "Please select portfolio"
            },
            footer_section: {
                required: "Please select footer section"
            },
            menu_status: {
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
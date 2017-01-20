@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')
@include('admin.ckeditor')


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Blog</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Blog
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

                    <form  enctype="multipart/form-data"  name="add_blog_form" id="add_blog_form" action="{{url('admin/edit-blog-details')}}" enctype="multipart-form/data" method="post">
                        <!-- /.col-lg-6 (nested) -->
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" name="blog_title" value="{{$dataArray["BlogData"][0]->title}}">
                        </div>
                        <div class="form-group">
                            <label>Blog Category</label>
                            <select name="blog_category" id="blog_category" class="form-control" >
                                <option selected="selected" disabled="disabled">Select Post Category</option>
                                <?php
                                foreach ($dataArray["blogCategories"] as $key => $val) {
                                    ?>
                                    <option value="{{$val->id}}"  <?php echo $dataArray["BlogData"][0]->category_id == $val->id ? 'selected="selected"' : ''; ?>  >{{$val->name}}</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Featured Image</label>
                            <?php
                            $blogImg = "";
                            if (isset($dataArray["BlogData"][0]->blogImg) && !empty($dataArray["BlogData"][0]->blogImg)) {
                                $blogImg = "111x111_" . $dataArray["BlogData"][0]->blogImg;
                            } else {
                                $blogImg = "default-img.png";
                            }
                            ?>
                            <img src="{{url('uploads/blogImg/'.$blogImg)}}" height="200px" width="200" />
                            <input type="file" accept="image/x-png,image/gif,image/jpeg" name="blog_bannerimg" id="files"/>
                            <img   id="prevImg" style="display:none" height="150" width="150"/>
                        </div>
                        <div class="form-group">
                            <label>Custom URL(optional):</label>
                            <input class="form-control" type="text" value="{{$dataArray["BlogData"][0]->custom_url}}" name="custom_url" id="custom_url"  />
                        </div>
                        <div class="form-group">
                            <label>Blog Content</label>
                            <textarea name="blog_content"  id="editor" rows="10" cols="80">{!!$dataArray["BlogData"][0]->description!!}</textarea>

                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="blog_status">
                                <option value="Active"  <?php echo $dataArray["BlogData"][0]->status == 'Active' ? 'selected="selected"' : ''; ?> >Active</option>
                                <option value="Inactive" <?php echo $dataArray["BlogData"][0]->status == 'Inactive' ? 'selected="selected"' : ''; ?> >Inactive</option>
                            </select>
                        </div>
                        <input type="hidden" name="blogId" value="{{$dataArray["BlogData"][0]->id}}" />
                        <input type="hidden" name="blog_slug" value="{{$dataArray["BlogData"][0]->blog_slug}}" />
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



    $(document).ready(function () {

        $(".files2").change(function () {
            var me = $(this);
            var index = $(".files2").index(me);
            if (this.files && this.files[0]) {
                var URL = window.URL || window.webkitURL;
                $('.prevImg1').eq(index).show();
                $('.prevImg1').eq(index).attr('src', URL.createObjectURL(this.files[0]));
            }
        });



    });
    /*****
     * validate the form
     */

//

    $("body #add_blog_form").validate({
        rules: {
            blog_title: {
                required: true
            },
            blog_category: {
                required: true
            },
            blog_bannerimg: {
                required: true
            },
            blog_content: {
                required: true
            }
        },
        messages: {
            blog_title: {
                required: "Please enter title"
            },
            blog_category: {
                required: "Please select category"
            },
            blog_bannerimg: {
                required: "Please select blog image"
            },
            blog_content: {
                required: "Please enter blog content"
            },
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
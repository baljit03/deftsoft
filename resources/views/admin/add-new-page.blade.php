@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')
@include('admin.ckeditor')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add New Page</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New Page
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

                    <form  enctype="multipart/form-data"  name="add_pages_form" id="add_pages_form" action="{{url('admin/add-pages-details')}}" enctype="multipart-form/data" method="post">
                        <!-- /.col-lg-6 (nested) -->
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" name="post_title" value="">
                        </div>

                        <div class="form-group">
                            <label>Featured Image</label>
                            <input type="file" accept="image/x-png,image/gif,image/jpeg" name="post_bannerimg" id="files"/>
                            <img   id="prevImg" style="display:none" height="150" width="150"/>
                        </div>
                        <div class="form-group">
                            <label>Custom URL(optional):</label>
                            <input class="form-control" type="text" name="custom_url" id="custom_url"  />
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="post_content"  id="editor4" rows="10" cols="80"></textarea>

                        </div>
                        <div class="form-group">
                            <label>Title1</label>
                            <input class="form-control" name="post_title1" value="">
                        </div>
                        <div class="form-group">
                            <label>Title2</label>
                            <input class="form-control" name="post_title2" value="">
                        </div>
                        <div class="form-group">
                            <label>Title3</label>
                            <textarea name="post_title3" id="editor" rows="10" cols="80"></textarea>
                            
                        </div>
                        <div class="form-group">
                            <label>Tag Line</label>
                            <textarea name="post_tagline" id="editor1" rows="10" cols="80"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Short Description</label>
                            <textarea name="post_short_desc" id="editor2" rows="10" cols="80"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Long Description</label>
                            <textarea name="post_long_description" id="editor3" rows="10" cols="80"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="post_status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Meta Title</label>
                            <textarea name="post_meta_title" id="post_meta_title" rows="10" cols="80"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Meta Keywords</label>
                            <textarea name="post_meta_keywords" id="post_meta_keywords" rows="10" cols="80"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea name="post_meta_description" id="post_meta_description" rows="10" cols="80"></textarea>
                        </div>


                        <hr/>
                        <h2>Add Post Meta Values(Optional)</h2>
                        <a href="javascript::void(0)" id="addTextBox">Add Text</a> |
                        <a href="javascript::void(0)" id="addFile">Add File</a>
                        <div id="metaTextTagDiv"></div>
                        <div id="metaFileTagDiv"></div>
                        <hr/>
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


        /****
         * Add Text Box
         */
        $("body").on("click", "#addTextBox", function () {
            time = $.now();
            var HTML = '<div class="main_text"><div class="form-group">';
            HTML += '<input type="text" class="metaKeyClass" id="key_' + time + '"  name="meta_key[' + k + ']"  placeholder="Key Name" />';
            HTML += '<input type="text" id="val_' + time + '"  name="meta_val[' + k + ']"  placeholder="Value" />';
            HTML += '<a href="javascript::void(0);" class="remove_text_file">Remove</a>';
            HTML += '</div></div>';
            $("#metaTextTagDiv").append(HTML);

            $("#key_" + time).rules("add", {
                required: true,
                messages: {
                    required: "Please enter key"
                }
            });
            $("#val_" + time).rules("add", {
                required: true,
                messages: {
                    required: "Please enter value"
                }
            });
            k++;

        });
        /****
         * Remove Input type File
         */
        $("body").on("click", ".remove_text_file,.remove_file", function () {
            var me = $(this);
            var r = confirm("Are you sure want to remove this meta?");
            if (r == true) {
                me.parent().parent().remove();
            }


        });
        /****
         * Add Input type File
         */
        $("body").on("click", "#addFile", function () {
            time = $.now();
            var HTML = '<div class="main_text"><div class="form-group">';
            HTML += '<input type="text" id="k_' + time + '" class="metaKeyClass"  name="meta_file_key[' + l + ']" placeholder="Key Name" />';
            HTML += '<input type="file" id="v_' + time + '"  accept="image/x-png,image/gif,image/jpeg" class="meta_file_value " name="meta_file_val[' + l + ']" placeholder="Value" />';
            HTML += '<img src="" style="display:none;" height="80" width="80" class="meta_file_value_img" />';
            HTML += '<a href="javascript::void(0);" class="remove_file">Remove</a>';
            HTML += '</div></div>';
            $("#metaFileTagDiv").append(HTML);
            $("#k_" + time).rules("add", {
                required: true,
                messages: {
                    required: "Please enter key"
                }
            });
            $("#v_" + time).rules("add", {
                required: true,
                messages: {
                    required: "Please enter value"
                }
            });
            l++;
        });
        $("body").on("change", ".meta_file_value", function () {
            var me = $(this);
            var index = $(".meta_file_value").index(me);
            if (this.files && this.files[0]) {
                var URL = window.URL || window.webkitURL;
                $('.meta_file_value_img').eq(index).show();
                $('.meta_file_value_img').eq(index).attr('src', URL.createObjectURL(this.files[0]));
            }
        });


    });
    /*****
     * validate the form
     */



    $("body #add_pages_form").validate({
        rules: {
            post_title: {
                required: true
            }
        },
        messages: {
            post_title: {
                required: "Please enter title"
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
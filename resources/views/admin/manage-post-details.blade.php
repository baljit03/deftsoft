@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')
@include('admin.ckeditor')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Post</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage Post
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
                    <?php
                    $userImg = "";
                    if (isset($dataArray["postDetails"][0]->banner) && !empty($dataArray["postDetails"][0]->banner)) {
                        $userImg = "250x250_" . $dataArray["postDetails"][0]->banner;
                    } else {
                        $userImg = "default-img.png";
                    }
                    ?>
                    <img src="{{url('uploads/bannerImg/'.$userImg)}}" height="200px" width="200" />
                    <form  enctype="multipart/form-data"  name="manage_pages_form" id="manage_pages_form" action="{{url('admin/mange-post-details')}}" enctype="multipart-form/data" method="post">
                        <!-- /.col-lg-6 (nested) -->
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" name="post_title" value="{{$dataArray["postDetails"][0]->title}}">
                        </div>
                        <div class="form-group">
                            <label>Post Category</label>
                            <select name="post_category" id="post_category" class="form-control" >
                                <option selected="selected" disabled="disabled">Select Post Category</option>
                                <option value="service" <?php echo $dataArray["postDetails"][0]->post_type == 'service' ? 'selected="selected"' : ''; ?>>Service</option>
                                <option value="subservice" <?php echo $dataArray["postDetails"][0]->post_type == 'subservice' ? 'selected="selected"' : ''; ?>>Subservice</option>
                                <option value="partner" <?php echo $dataArray["postDetails"][0]->post_type == 'partner' ? 'selected="selected"' : ''; ?>>Partner</option>
                                <option value="ourwork" <?php echo $dataArray["postDetails"][0]->post_type == 'ourwork' ? 'selected="selected"' : ''; ?>>Our Work</option>
                                <option value="portfolio-category" <?php echo $dataArray["postDetails"][0]->post_type == 'portfolio-category' ? 'selected="selected"' : ''; ?>>Portfolio Category</option>
                                <option value="client-logo" <?php echo $dataArray["postDetails"][0]->post_type == 'client-logo' ? 'selected="selected"' : ''; ?>>Client Logo</option>
                                
                            </select>
                        </div>

                        <div class="form-group" id="service_div">
                            <?php if ($dataArray["postDetails"][0]->post_type == 'subservice') { ?>
                                <label>Parent Category</label>
                                <select name="parent_service" class="form-control"><option selected="selected" disabled="disabled">Select Service</option>
                                    <?php foreach ($dataArray["ServiceData"] as $key => $val) {
                                        ?>
                                        <option value="<?php echo $val->id; ?>" <?php echo $dataArray["postDetails"][0]->parent_id == $val->id ? 'selected="selected"' : ''; ?> ><?php echo $val->title; ?></option>

                                    <?php } ?>  

                                </select>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Custom URL(optional):</label>
                            <input type="text" class="form-control" value="{{$dataArray["postDetails"][0]->custom_slug}}" name="custom_url" id="custom_url"  />
                        </div>
                        <div class="form-group">
                            <label>Featured Image</label>
                            <input type="file" name="post_bannerimg" id="files"/>
                            <img   id="prevImg" style="display:none" height="150" width="150"/>
                            <input type="hidden" name="prev_feature_img" value="{{$dataArray["postDetails"][0]->banner}}">

                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="post_content"  id="editor" rows="10" cols="80">{{$dataArray["postDetails"][0]->content}}</textarea>

                        </div>

                        <div class="form-group">
                            <label>Title1</label>
                            <input class="form-control" name="post_title1" value="{{$dataArray["postDetails"][0]->title1}}">
                        </div>
                        <div class="form-group">
                            <label>Title2</label>
                            <input class="form-control" name="post_title2" value="{{$dataArray["postDetails"][0]->title2}}">
                        </div>
                        <div class="form-group">
                            <label>Title3</label>

                            <textarea name="post_title3" id="editor1" rows="10" cols="80">value="{{$dataArray["postDetails"][0]->title3}}</textarea>

                        </div>
                        <div class="form-group">
                            <label>Tag Line</label>
                              <textarea name="post_tagline" id="editor2" rows="10" cols="80">{{$dataArray["postDetails"][0]->tagline}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Short Description</label>
                            <textarea name="post_short_desc" id="editor3" rows="10" cols="80">
                                        {{$dataArray["postDetails"][0]->short_description}} 
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label>Long Description</label>
                            <textarea name="post_long_description" id="editor4" rows="10" cols="80">
                                {{$dataArray["postDetails"][0]->long_description}} 
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="post_status">
                                <option value="Active" <?php $dataArray["postDetails"][0]->status == 'Active' ? 'selected="selected"' : ''; ?>>Active</option>
                                <option value="Inactive" <?php $dataArray["postDetails"][0]->status == 'Inactive' ? 'selected="selected"' : ''; ?>>Inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Meta Title</label>
                            <textarea name="post_meta_title" id="post_meta_title" rows="10" cols="80">{{$dataArray["postDetails"][0]->meta_title}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Meta Keywords</label>
                            <textarea name="post_meta_keywords" id="post_meta_keywords" rows="10" cols="80">{{$dataArray["postDetails"][0]->meta_keywords}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea name="post_meta_description" id="post_meta_description" rows="10" cols="80">{{$dataArray["postDetails"][0]->meta_description }}</textarea>
                        </div>


                        <hr/>
                        <h2>Add Post Meta Values(Optional)</h2>
                        <a href="javascript::void(0)" id="addTextBox">Add Text/Url</a> |
                        <a href="javascript::void(0)" id="addFile">Add File</a>

                        <div id="metaTextTagDiv">
                            <?php $textSize = 0; ?>
                            @foreach($dataArray["postDetails"][0]->postDetail as $key=>$val)
                            @if($val['postmeta_type']!='image')

                            <div class="main_text">
                                <div class="form-group">
                                    <input type="text" class="metaKeyClass metaKeyClass2" id="key_<?php echo $textSize; ?>"  value="{{$key}}" name="meta_key[<?php echo $textSize; ?>]"  placeholder="Key Name" />
                                    <input type="text" class="metaValueClass2" id="val_<?php echo $key; ?>" value="{{$val['value']}}" name="meta_val[<?php echo $textSize; ?>]"  placeholder="Value" />
                                    <a href="javascript::void(0);" class="remove_text_file">Remove</a>
                                </div>
                            </div>
                            <?php $textSize++; ?>
                            @endif
                            @endforeach
                        </div>
                        <div id="metaFileTagDiv">
                            <?php $textSize1 = 0; ?>
                            @foreach($dataArray["postDetails"][0]->postDetail as $key=>$val)
                            @if($val['postmeta_type']=='image')
                            <?php $img = isset($val['value']) && !empty($val['value']) ? "48x48_" . $val['value'] : 'deault.jpg'; ?>
                            <div class="main_text"><div class="form-group">
                                    <input type="text" id="k_<?php echo $textSize1; ?>" class="metaKeyClass metaKeyClass3"  name="meta_file_key[]" value="{{$key}}" placeholder="Key Name" />
                                    <img src="{{url('uploads/postmetaImg/'.$img)}}"  height="80" width="80"  />
                                    <input type="hidden" name="meta_file_prev_val_<?php echo $key; ?>" value="{{$val['value']}}" />
                                    <input type="file" id="v_<?php echo $key; ?>"  accept="image/x-png,image/gif,image/jpeg" class="meta_file_value " name="meta_file_val[]" placeholder="Value" />
                                    <img src="" style="display:none;" height="80" width="80" class="meta_file_value_img" />
                                    <a href="javascript::void(0);" class="remove_file">Remove</a>
                                </div></div>
                            <?php $textSize1++; ?>
                            @endif
                            @endforeach
                        </div>




                        <hr/>
                        <div class="form-group">
                            <label>Last Updated by</label>
                            <p>
                                @if(isset($dataArray["postDetails"][0]->updateByUserDetail)&&!empty($dataArray["postDetails"][0]->updateByUserDetail))
                                {{$dataArray["postDetails"][0]->updateByUserDetail->firstname.' '.$dataArray["postDetails"][0]->updateByUserDetail->firstname." (".$dataArray["postDetails"][0]->updateByUserDetail->usertype.")" }}
                            <p>{{date("Y-m-d H:i:s",strtotime($dataArray["postDetails"][0]->updated_at))}} </p>
                            @else
                            {{$dataArray["postDetails"][0]->userDetail->firstname.' '.$dataArray["postDetails"][0]->userDetail->firstname." (".$dataArray["postDetails"][0]->userDetail->usertype.")" }}
                            <p>{{date("Y-m-d H:i:s",strtotime($dataArray["postDetails"][0]->created_at))}} </p>
                            @endif
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Posted By : </label>
                            <p>{{$dataArray["postDetails"][0]->userDetail->firstname.' '.$dataArray["postDetails"][0]->userDetail->firstname." (".$dataArray["postDetails"][0]->userDetail->usertype.")" }} </p>
                            <p>{{date("Y-m-d H:i:s",strtotime($dataArray["postDetails"][0]->created_at))}} </p>
                        </div>
                        <input type="hidden" name="postId" value="{{$dataArray["postDetails"][0]->id}}" />
                        <input type="hidden" name="slug" value="{{$dataArray["postDetails"][0]->post_slug}}" />
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
    var k = <?php echo $textSize ?>;
    var l = <?php echo $textSize1 ?>;
   
    var ServiceTemplate = '';
<?php foreach ($dataArray["ServiceData"] as $key => $val) {
    ?>
        ServiceTemplate += '<option value="<?php echo $val->id; ?>"><?php echo $val->title; ?></option>';

<?php } ?>
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
            HTML += '<input type="text" class="" id="key_' + time + '"  name="meta_key[' + k + ']"  placeholder="Key Name" />';
            HTML += '<input type="text" class="" id="val_' + time + '"  name="meta_val[' + k + ']"  placeholder="Value" />';
            HTML += '<a href="javascript::void(0);" class="remove_text_file">Remove</a>';
            HTML += '</div></div>';
            k++;
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
                url: "{{url('admin/custom_url_check')}}",
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
    /*****
     * validate the form
     */

    $("body").on("click", ".form_button", function () {




    });

    $("#manage_pages_form").validate({
        rules: {
            post_title: {
                required: true
            },
        },
        messages: {
            post_title: {
                required: "Please enter title"
            }
        },
        submitHandler: function (form) {
//            return false;
            form.submit();
        }

    });

    $(".metaKeyClass2,.metaKeyClass3").each(function () {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Please enter key"
            }
        });
    });
    /***
     * 
     *  Service category List
     */
    $("body").on("change", "#post_category", function () {
        var me = $(this);
        var value = me.val();
        if (value == 'subservice') {
            var HTML = '<label>Parent Category</label>';
            HTML += '<select name="parent_service" class="form-control"><option selected="selected" disabled="disabled">Select Service</option>';
            HTML += ServiceTemplate;
            HTML += '</select>';
            $("#service_div").html(HTML);
        } else {
            $("#service_div").html('');

        }
    });

</script>
@endsection
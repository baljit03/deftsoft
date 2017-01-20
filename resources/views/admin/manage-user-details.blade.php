@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')
<div id="page-wrapper">
    <?php
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage User Detail</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage User Detail

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
                    <?php
                    $userImg = "";
                    if (isset($dataArray["userData"][0]->profie_image) && !empty($dataArray["userData"][0]->profie_image)) {
                        $userImg = "250x250_" . $dataArray["userData"][0]->profie_image;
                    } else {
                        $userImg = "default-img.png";
                    }
                    ?>
                    <img src="{{url('uploads/userProfile/'.$userImg)}}" height="200px" width="200" />
                    <form enctype="multipart/form-data" action="{{url('admin/manage-user-detail')}}" method="post" id="manage_user_form" name="manage_user_form" class="manage_user_form">
                        <!-- /.col-lg-6 (nested) -->
                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" name="first_name" value="{{$dataArray["userData"][0]->firstname}}">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" name="last_name" value="{{$dataArray["userData"][0]->lastname}}">
                        </div>
                        <div class="form-group">
                            <label>Email</label> 
                            <p>{{$dataArray["userData"][0]->email}}</p>
                            <!--<input class="form-control" name="email" value="{{$dataArray["userData"][0]->email}}">-->
                        </div>

                        <div class="form-group">
                            <label>Country</label>
                            <input class="form-control" name="country" value="{{$dataArray["userData"][0]->country}}">
                        </div>

                        <div class="form-group">
                            <label>State</label>
                            <input class="form-control" name="state" value="{{$dataArray["userData"][0]->state}}">
                        </div>

                        <div class="form-group">
                            <label>City</label>
                            <input class="form-control" name="city" value="{{$dataArray["userData"][0]->city}}">
                        </div>

                        <div class="form-group">
                            <label>Zip Code</label>
                            <input class="form-control" name="zipcode" value="{{$dataArray["userData"][0]->zipcode}}">
                        </div>

                        <div class="form-group">
                            <label>Address1</label>
                            <textarea name="address1"  id="post_content" rows="10" cols="80">{{$dataArray["userData"][0]->address1}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Address2</label>
                            <textarea name="address2"  id="post_content" rows="10" cols="80">{{$dataArray["userData"][0]->address2}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Profile Image</label>
                            <input type="file" id="files" name="profie_image"/>
                            <img src="" id="prevImg" style="display:none" height="150" width="150"/>

                            <input type="hidden" name="prev_profie_image" value="{{$dataArray["userData"][0]->profie_image}}">
                        </div>

                        <div class="form-group">
                            <label>Timezone</label>
                            <select name="timezone" class="form-control">
                                <option value="" selected="selected" disabled="disabled">Choose Timezone</option>
                                <option title="Asia/Kolkata" <?php echo isset($dataArray["userData"][0]->timezone) && $dataArray["userData"][0]->timezone == 'Asia/Kolkata' ? 'selected="selected"' : ''; ?> value="Asia/Kolkata">India</option>
                                <option title="Alaska"  <?php echo isset($dataArray["userData"][0]->timezone) && $dataArray["userData"][0]->timezone == 'America/Anchorage' ? 'selected="selected"' : ''; ?> value="America/Anchorage">Alaska</option>
                                <option title="Central" <?php echo isset($dataArray["userData"][0]->timezone) && $dataArray["userData"][0]->timezone == 'America/Chicago' ? 'selected="selected"' : ''; ?> value="America/Chicago">Central</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="" selected="selected" disabled="disabled">Select Status</option>
                                <option value="active" <?php echo isset($dataArray["userData"][0]->status) && $dataArray["userData"][0]->status == 'active' ? 'selected="selected"' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo isset($dataArray["userData"][0]->status) && $dataArray["userData"][0]->status == 'inactive' ? 'selected="selected"' : ''; ?>>Inactive</option>
                                <option value="deleted" <?php echo isset($dataArray["userData"][0]->status) && $dataArray["userData"][0]->status == 'deleted' ? 'selected="selected"' : ''; ?>>Deleted</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" name="gender">
                                <option value="" selected="selected" disabled="disabled">Select Gender</option>
                                <option value="male" <?php echo isset($dataArray["userData"][0]->gender) && $dataArray["userData"][0]->gender == 'male' ? 'selected="selected"' : ''; ?> >male</option>
                                <option value="female" <?php echo isset($dataArray["userData"][0]->gender) && $dataArray["userData"][0]->gender == 'female' ? 'selected="selected"' : ''; ?>>female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="usertype">
                                <option value="" selected="selected" disabled="disabled">Select Role</option>
                                <!--<option value="superadmin">Super Admin</option>-->
                                <option value="admin" <?php echo isset($dataArray["userData"][0]->usertype) && $dataArray["userData"][0]->usertype == 'admin' ? 'selected="selected"' : ''; ?>>Admin</option>
                                <option value="others" <?php echo isset($dataArray["userData"][0]->usertype) && $dataArray["userData"][0]->usertype == 'others' ? 'selected="selected"' : ''; ?>>Others</option>
                            </select>
                        </div>
                        <input type="hidden" name='userId' value="{{$dataArray["userData"][0]->id}}"/>    
                        <input type="hidden" name='userslug' value="{{$dataArray["userData"][0]->user_slug}}"/>    
                        <input type="hidden" name='_token' value="{{csrf_token()}}"/>    
                        <input type="submit" id="manage_user_form_btn" class="btn btn-default" value="Submit Button" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $.validator.addMethod("lettersonly", function (value, element) {
            return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Letters only please");
        $("body").on("click", "#manage_user_form_btn", function () {
            var me = $(this);
            $("#manage_user_form").validate({
                rules: {
                    first_name: {
                        required: true,
                        lettersonly: true
                    },
                    last_name: {
                        required: true,
                        lettersonly: true
                    },
                    country: {
                        required: true,
                        lettersonly: true
                    },
                    state: {
                        required: true,
                        lettersonly: true
                    },
                    city: {
                        required: true,
                        lettersonly: true
                    },
                    zipcode: {
                        required: true,
                        maxlength: 6,
                        minlength: 5
                    },
                    address1: {
                        required: true
                    },
                    timezone: {
                        required: true
                    },
                    status: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    usertype: {
                        required: true
                    }
                },
                messages: {
                    first_name: {
                        required: "Please enter first name",
                        lettersonly: "Pleas enter vaild name"
                    },
                    last_name: {
                        required: "Please enter last name",
                        lettersonly: "Pleas enter vaild name"
                    },
                    country: {
                        required: "Please enter country",
                        lettersonly: "Please enter vaild name"
                    },
                    state: {
                        required: "Please enter state",
                        lettersonly: "Please enter vaild state"
                    },
                    city: {
                        required: "Please enter city",
                        lettersonly: "Please enter vaild city"
                    },
                    zipcode: {
                        required: "Please enter zipcode",
                        maxlength: "Please enter valid zipcode",
                        minlength: "Please enter valid zipcode"
                    },
                    address1: {
                        required: "Please enter address"
                    },
                    timezone: {
                        required: "Please select timezone "
                    },
                    status: {
                        required: "Please select status"
                    },
                    gender: {
                        required: "Please select gender"
                    },
                    usertype: {
                        required: "Please select role"
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
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
</script>

@endsection
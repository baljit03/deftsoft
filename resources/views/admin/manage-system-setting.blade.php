@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Setting</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Update Setting
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

                    <form  enctype="multipart/form-data"  name="manage_system_settings" id="manage_system_settings" action="{{url('admin/mange-system-setting')}}" enctype="multipart-form/data" method="post">
                        <!-- /.col-lg-6 (nested) -->
                        <div class="form-group">
                            <label>Setting Name</label>
                            {{ucfirst(str_replace("_"," ",$dataArray["settingData"]->key))}}
                        </div>
                        <div class="form-group">
                            <label>Value</label>
                            <input type="text" class="form-control" value="{{$dataArray["settingData"]->value}}" name="setting_value" id="custom_url"  />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            @if($dataArray["settingData"]->setting_type == 'image')  
                            <input type="file" name="setting_Img" id="files"/>
                            <img src="{{url("uploads/systemImg/".$dataArray["settingData"]->extra_info)}}" height="60" width="250"/>
                            <img   id="prevImg" style="display:none" height="150" width="150"/>
                            <input type="hidden" name="prev_system_img" value="{{$dataArray["settingData"]->extra_info}}">

                            @else
                            <textarea class="form-control" name="description">{{$dataArray["settingData"]->extra_info}}</textarea>
                            @endif
                            <input type="hidden" name="prev_setting_type" value="{{$dataArray["settingData"]->setting_type}}">
                            <input type="hidden" name="key" value="{{$dataArray["settingData"]->key}}">



                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            {{ucfirst(str_replace("_"," ",$dataArray["settingData"]->setting_type))}}
                        </div>


                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="setting_status">
                                <option value="Active" <?php $dataArray["settingData"]->status == 'Active' ? 'selected="selected"' : ''; ?>>Active</option>
                                <option value="Inactive" <?php $dataArray["settingData"]->status == 'Inactive' ? 'selected="selected"' : ''; ?>>Inactive</option>
                            </select>
                        </div>


                        <input type="hidden" name="setting_id" value="{{$dataArray["settingData"]->id}}" />
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <input type="submit" class="form_button btn btn-default" value="Submit Button" />

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#manage_system_settings").validate({
        rules: {
            setting_value: {
                required: true
            },
            setting_Img: {
                required: true
            },
            description: {
                required: true
            },
            setting_status: {
                required: true
            }
        },
        messages: {
            setting_value: {
                required: "Please enter value"
            },
            setting_Img: {
                required: "Please select file"
            },
            description: {
                required: "Please enter description"
            },
            setting_status: {
                required: "Please select status"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }

    });

    /***
     * 
     *To preview the image
     */$(document).ready(function () {

        $('#files').change(function () {

            var reader = new FileReader();

            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                $("#prevImg").show();
                document.getElementById("prevImg").src = e.target.result;
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
    });

</script>
@endsection
@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')
@include('admin.ckeditor')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add New Job</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New Job
                    <a href=""></a>
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

                    <form  enctype="multipart/form-data"  name="add_job_form" id="add_job_form" action="{{url('admin/add-job-details')}}" enctype="multipart-form/data" method="post">
                        <!-- /.col-lg-6 (nested) -->
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" name="job_title" value="">
                        </div>
                        <div class="form-group">
                            <label>Job Category</label>
                            <select name="job_category" id="job_category" class="form-control" >
                                <option selected="selected" disabled="disabled">Select Job Category</option>
                                <?php
                                foreach ($dataArray["jobCategoryData"] as $key => $val) {
                                    ?>
                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Required Experience</label>
                            <select name="req_exp" id="req_exp" class="form-control" >
                                <option selected="selected" disabled="disabled">Select Required Experience</option>
                                <option  value="0 to 6 months">0 to 1/2 Year</option>
                                <option  value="1 year">1 Years</option>
                                <option  value="2 years">2 Years</option>
                                <option  value="3 years">3 Years</option>
                                <option  value="4 years">4 Years</option>
                                <option  value="5 years">5 Years</option>
                                <option  value="6 years">6 Years</option>
                                <option  value="7 years">7 Years</option>
                                <option  value="8 years">8 Years</option>
                                <option  value="8+ years">8+ Years</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Job Location</label>
                            <select name="job_location" id="job_location" class="form-control" >
                                <option selected="selected" disabled="disabled">Select Job Location</option>
                                <option  value="Mohali">Mohali</option>
                                <option  value="Chandigarh">Chandigarh</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Professional Experience</label>
                            <select name="professional_exp" id="professional_exp" class="form-control" >
                                <option selected="selected" disabled="disabled">Select Professional Experience</option>
                                <option  value="0 to 6 months">0 to 1/2 Year</option>
                                <option  value="1 year">1 Years</option>
                                <option  value="2 years">2 Years</option>
                                <option  value="3 years">3 Years</option>
                                <option  value="4 years">4 Years</option>
                                <option  value="5 years">5 Years</option>
                                <option  value="6 years">6 Years</option>
                                <option  value="7 years">7 Years</option>
                                <option  value="8 years">8 Years</option>
                                <option  value="8+ years">8+ Years</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No of Vacancies</label>
                            <input class="form-control" name="no_of_vacancy" value="">
                        </div>

                        <div class="form-group" id="service_div">

                        </div>

                        <div class="form-group">
                            <label>Job Summary</label>
                            <textarea name="job_summary"  id="editor" rows="10" cols="80"></textarea>

                        </div>
                        <div class="form-group">
                            <label>Required Skills</label>
                            <textarea name="skills_required"  id="editor1" rows="10" cols="80"></textarea>

                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="job_status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
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

    $("body #add_job_form").validate({
        rules: {
            job_title: {
                required: true
            },
            job_category: {
                required: true
            },
            req_exp: {
                required: true
            },
            job_location: {
                required: true
            },
            professional_exp: {
                required: true
            },
            no_of_vacancy: {
                required: true,
                number: true
            },
            job_summary: {
                required: true
            },
            skills_required: {
                required: true
            }
        },
        messages: {
            job_title: {
                required: "Please enter title"
            },
            job_category: {
                required: "Please select category"
            },
            req_exp: {
                required: "Please select expereince"
            },
            job_location: {
                required: "Please select job location"
            },
            professional_exp: {
                required: "Please select expereince"
            },
            no_of_vacancy: {
                required: "Please enter no of opening",
                number: "Please enter vaild number"
            },
            job_summary: {
                required: "Please enter job summary"
            },
            skills_required: {
                required: "Please enter skills"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }

    });
</script>
@endsection
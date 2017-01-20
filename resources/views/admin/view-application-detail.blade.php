@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Appliction Details</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Application Details
                </div>
                <!-- /.panel-heading -->
                <div id="mainMessageDv">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(Session::has('message'))
                    <div id="msg_div" class="alert alert-success">
                        <a class="close" data-dismiss="alert">×</a>
                        <strong>Success!</strong> {!!Session::get('message')!!}
                    </div>
                    <script>
                        setTimeout(function () {
                            $("#msg_div").remove();
                        }, 3000);</script>


                    @endif
                </div>
                <div class="panel-body">
                    <div class="panel-body">
                        <h3>Job Details</h3>
                        <table>
                            <tr><th>Job Category</th><td>{{$dataArray['jobApplications']->categoryData->name}}</td></tr>
                            <tr><th>Title</th><td>{{$dataArray['jobApplications']->jobDetail->job_title}}</td></tr>
                            <tr><th>Exp. Required</th><td>{{$dataArray['jobApplications']->jobDetail->exp_required}}</td></tr>
                            <tr><th>Job Location</th><td>{{$dataArray['jobApplications']->jobDetail->job_location}}</td></tr>
                            <tr><th>Professional Exp.</th><td>{{$dataArray['jobApplications']->jobDetail->profession_exp}}</td></tr>
                            <tr><th>Job Summary</th><td>{!!$dataArray['jobApplications']->jobDetail->job_summary!!}</td></tr>
                            <tr><th>Required Skills</th><td>{!!$dataArray['jobApplications']->jobDetail->skills!!}</td></tr>


                        </table>
                        <h3>Applicant Details</h3>
                        <table>
                            <tr><th>Name</th><td>{{$dataArray['jobApplications']->app_name}}</td></tr>
                            <tr><th>Email</th><td>{{$dataArray['jobApplications']->app_email}}</td></tr>
                            <tr><th>Contact Number</th><td>{{$dataArray['jobApplications']->app_phone}}</td></tr>
                            <tr><th>Resume</th><td>{{$dataArray['jobApplications']->app_name}}</td></tr>
                            <tr><th>Applied on</th><td>{{$dataArray['jobApplications']->created_at}}  </td></tr>
                        </table>


                        <form action="{{url('admin/update-jobapplication')}}"  method="post" name="change_jobstatus_form" id="change_jobstatus_form">
                            <fieldset>
                                <div class="form-group">
                                    <label>Change Status</label>
                                    <select class="form-control" name="application_status">
                                        <option value="" selected="selected" disabled="disabled">Select Status</option>
                                        <option value="active"  <?php echo $dataArray['jobApplications']->status == 'active'?  'selected="selected" ':''; ?> >Active</option>
                                        <option value="inactive" <?php echo $dataArray['jobApplications']->status == 'inactive'?  'selected="selected" ':''; ?>>Inactive</option>
                                        <option value="rejected" <?php echo $dataArray['jobApplications']->status == 'rejected'?  'selected="selected" ':''; ?>>Reject</option>
                                    </select>
                                </div>
                                <input  name="application_id" type="hidden" value="{{$dataArray['jobApplications']->id}}">
                                <input  name="_token" type="hidden" value="{{csrf_token()}}">
                                <input type="submit" class="btn btn-lg btn-primary btn-block" id="change_btn" value="Update"/>
                            </fieldset>
                        </form>
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-------Datatables Queries------->

<!-------Datatables Queries------->
@endsection


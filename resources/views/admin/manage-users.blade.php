@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')


<div id="page-wrapper" class="manage-pages">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Users</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="pull-left">Add New User </h4>
                                    <a href="{{url('admin/add-new-user')}}" class="btn btndefault pull-right"><i class="fa fa-plus"></i> Add New</a>
                </div>

                <!-- /.panel-heading -->
                <div id="mainMessageDv">
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
                    <table  width="100%" class="table table-striped table-bordered table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Timezone</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>Role</th>
                                <th>Created</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($dataArray["userList"])>0)
                            @foreach($dataArray["userList"] as $key=>$val)
                            <?php
                            $userImg = "";
                            if (isset($val->profie_image) && !empty($val->profie_image)) {
                                $userImg = '250x250_' . $val->profie_image;
                            } else {
                                $userImg = "default-img.png";
                            }
                            ?>
                            <tr class="gradeX">
                                <td><img src="{{url('uploads/userProfile/'.$userImg)}}" height="50" width="50"/></td>
                                <td>{{$val->firstname}} {{$val->lastname}}</td>
                                <td>{{$val->email}}</td>
                                <td>{{$val->timezone}}</td>
                                <td>{{ucfirst($val->gender)}}</td>
                                <td>{{ucfirst($val->status)}}</td>
                                <td>{{ucfirst($val->usertype)}}</td>
                                <td>{{date("Y-m-d H:i:s",strtotime($val->created_at))}}</td>
                                <td><a href="{{url('/admin/manage-user-detail/'.$val->user_slug)}}" >Edit</a></td>
                                <td><a href="javascript:void(0);" class="deleteUser" data-uid="{{$val->id}}">Delete</a></td>
                            </tr>
                            @endforeach
                            @else
                            <tr class="gradeX">
                                <td colspan="10" style="text-align: center">No Record Found!</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

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
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
        /****
         * TO delete the users
         */
        $("body").on("click", ".deleteUser", function () {
            var me = $(this);
            var index = $(".deleteUser").index(me);
            var userId = me.attr("data-uid");
            var check = confirm("Are you sure want to delete?");
            var dataString = "user_id=" + userId + "&_token={{csrf_token()}}";
            if (check == true) {
                $.ajax({
                    data: dataString,
                    url: "delete-users",
                    type: "POST",
                    beforeSend: function (xhr) {

                    },
                    success: function (data) {
                        var HTML = '<div id="msg_div" class="alert alert-success"><a class="close" data-dismiss="alert">×</a>';
                        HTML += '<strong>Success!</strong>Selected user successfully mark as deleted!</div>';
                        $("#mainMessageDv").html(HTML);
                        setTimeout(function () {
                            me.parent().parent().remove();
                            window.location.reload();
                        }, 3000);
                    }
                });
            }
        });
    });
</script>
<!-------Datatables Queries------->
@endsection


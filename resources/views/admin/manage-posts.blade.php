@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Posts</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage Posts
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
                <a href="{{url('admin/add-new-post')}}">Add New Post</a>
                <div class="panel-body">
                    <table  width="100%" class="table table-striped table-bordered table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Post Title</th>
                                <th>Post Type</th>
                                <th>Posted By</th>
                                <th>Updated_by</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @if(count($dataArray["managePostData"])>0)
                            @foreach($dataArray["managePostData"] as $key=>$val)
                            <tr class="gradeX">
                                <td>{{$val->title}}</td>
                                <td>{{$val->post_type}}</td>
                                <td>{{$val->userDetail->firstname}} {{$val->userDetail->lastname}} ({{$val->userDetail->usertype}})</td>
                                @if(isset($val->updateByUserDetail->firstname)&&!empty($val->updateByUserDetail->firstname))
                                <td>{{$val->updateByUserDetail->firstname}} {{$val->updateByUserDetail->lastname}} ({{$val->updateByUserDetail->usertype}})</td>
                                @else
                                <td>--</td>
                                @endif
                                <td>{{$val->status}}</td>
                                <td>{{date("Y-m-d",strtotime($val->created_at))}}</td>
                                <td><a href="{{ url('/admin/edit-posts/'.$val->post_slug)}}"  class="editPage">Edit</a></td>
                                <td><a href="javascript:void(0);" data-val="{{$val->id}}" class="deleteaPage">Delete</a></td>
                            </tr>
                            @endforeach
                            @else
                            <tr class="gradeX">
                                <td>No Record Found!</td>
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
        /***
         * To detele the pages
         */
        $("body").on("click", ".deleteaPage", function () {
            var me = $(this);
            var index = $(".deleteaPage").index(me);
            var r = confirm("Are you sure want to delete this page?");
            if (r == true) {
                var postId = me.attr("data-val");
                var dataString = "post_id=" + postId + "&_token={{csrf_token()}}";
                $.ajax({
                    url: "delete-page",
                    data: dataString,
                    type: "POST",
                    beforeSend: function (xhr) {

                    },
                    success: function (data) {
                        var HTML = '<div id="msg_div" class="alert alert-success"><a class="close" data-dismiss="alert">×</a>';
                        HTML += '<strong>Success!</strong>Selected page successfully mark as deleted!</div>';
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


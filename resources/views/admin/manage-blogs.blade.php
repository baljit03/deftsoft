@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Blog</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage Blog
                </div>
                <!-- /.panel-heading -->
                <div id="mainMessageDv">
                    @if(Session::has('message'))
                    <div id="msg_div" class="alert alert-success">
                        <a class="close" data-dismiss="alert">X</a>
                        <strong>Success!</strong> {!!Session::get('message')!!}
                    </div>
                    <script>
                        setTimeout(function () {
                            $("#msg_div").remove();
                        }, 3000);</script>


                    @endif
                </div>
                <a href="{{url('admin/add-new-blog')}}">Add New Blog</a>
                <div class="panel-body">
                    <table  width="100%" class="table table-striped table-bordered table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Blog Category</th>  
                                <th>Description</th>  
                                <th>Blog Image</th>  
                                <th>Status</th>
                                <th>Created at</th>  
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @if(count($dataArray["BlogData"])>0)
                            @foreach($dataArray["BlogData"] as $key=>$val)
                            <tr class="gradeX">
                                <td>{{$val->title}}</td>
                                <td>{{$val->category_data->name}}</td>
                                <td>{{substr(strip_tags($val->description),0,250)}}</td>
                                <td><img class="img-responsive" src="{{url('/uploads/blogImg/111x111_' . $val->blogImg)}}" alt=""></td>  
                                <td>{{$val->status}}</td>
                                <td>{{$val->created_at}}</td>
                                <td><a href="{{ url('/admin/edit-blog/'.$val->blog_slug)}}"  class="editBlog">Edit</a></td>
                                <td><a href="javascript:void(0);" data-val="{{$val->id}}" class="deleteBlog">Delete</a></td>

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
        $("body").on("click", ".deleteBlog", function () {
            var me = $(this);
            var index = $(".deleteBlog").index(me);
            var r = confirm("Are you sure want to delete this blog?");
            if (r == true) {
                var blogId = me.attr("data-val");
                var dataString = "blog_id=" + blogId + "&_token={{csrf_token()}}";
                $.ajax({
                    url: "delete-blog",
                    data: dataString,
                    type: "POST",
                    beforeSend: function (xhr) {

                    },
                    success: function (data) {
                        var HTML = '<div id="msg_div" class="alert alert-success"><a class="close" data-dismiss="alert">X</a>';
                        HTML += '<strong>Success!</strong>Selected blog successfully mark as deleted!</div>';
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


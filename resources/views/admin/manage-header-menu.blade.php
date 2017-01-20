@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')
@include('admin.ckeditor')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Header Menu</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage Header Menu
                </div> 
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
            </div>
             
 
                    <div class="panel-body">
                            <a href="{{url('admin/add-new-header-menu')}}">Add New Header Menu</a>
                        <table  width="100%" class="table table-striped table-bordered table-hover" id="example2">
                            <thead>
                                <tr>
                                    <th>Menu Name</th>
                                    <th>Link to </th>  
                                    <th>Status</th>  
                                     <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @if(count($dataArray["headerMenuData"])>0)
                                @foreach($dataArray["headerMenuData"] as $key=>$val)
                                <tr class="gradeX">
                                    <td>{{$val->name}}</td>
                                    <td>{{$val->postDetail->title}}</td>
                                    <td>{{$val->status}}</td>
                                    <td><a href="{{url('admin/edit-header-menu/'.$val->id)}}">Edit</a></td>
                                    <td><a href="javascript:void(0);" data-val="{{$val->id}}" class="deleteRecord">Delete</a></td>

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
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
        /***
         * To detele the pages
         */
        $("body").on("click", ".deleteRecord", function () {
            var me = $(this);
            var index = $(".deleteRecord").index(me);
            var r = confirm("Are you sure want to delete this record?");
            if (r == true) {
                var record_id = me.attr("data-val");
                var dataString = "record_id=" + record_id + "&_token={{csrf_token()}}";
                $.ajax({
                    url: "delete-header-menu",
                    data: dataString,
                    type: "POST",
                    beforeSend: function (xhr) {

                    },
                    success: function (data) {
                        var HTML = '<div id="msg_div" class="alert alert-success"><a class="close" data-dismiss="alert">X</a>';
                        HTML += '<strong>Success!</strong>Selected Record successfully mark as deleted!</div>';
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
@endsection
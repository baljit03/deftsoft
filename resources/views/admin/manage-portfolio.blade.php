@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')


<div id="page-wrapper" class="manage-pages">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Portfolio</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="pull-left">Add New Portfolio</h4>
                     <a href="{{url('admin/add-new-portfolio')}}" class="btn btndefault pull-right"><i class="fa fa-plus"></i> Add New</a>
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
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Url</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($dataArray["PortfolioData"])>0)
                            @foreach($dataArray["PortfolioData"] as $key=>$val)
                            <tr class="gradeX">
                                <?php
                                $userImg = "";
                                if (isset($val->portfolioImg) && !empty($val->portfolioImg)) {
                                    $portfolioImg = '111x111_' . $val->portfolioImg;
                                } else {
                                    $portfolioImg = "default-img.png";
                                }
                                ?>
                                <td><img src="{{url('uploads/portfolioImg/'.$portfolioImg)}}" height="50" width="50"/></td>
                                <td>{{$val->title}}</td>
                                <td>{{$val->category_data->title}}</td>
                                <td>{{$val->projectUrl}}</td>

                                <td>{{$val->status}}</td>
                                <td>{{date("Y-m-d",strtotime($val->created_at))}}</td>
                                <td><a href="{{ url('/admin/edit-portfolio/'.$val->id)}}"  class="editPortfolio edit-btn">Edit</a></td>
                                <td><a href="javascript:void(0);" data-val="{{$val->id}}" class="deletePortfolio delete-btn">Delete</a></td>
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
        $("body").on("click", ".deletePortfolio", function () {
            var me = $(this);
            var index = $(".deleteaPage").index(me);
            var r = confirm("Are you sure want to delete this portfolio?");
            if (r == true) {
                var record_id = me.attr("data-val");
                var dataString = "record_id=" + record_id + "&_token={{csrf_token()}}";
                $.ajax({
                    url: "delete-portfolio-record",
                    data: dataString,
                    type: "POST",
                    beforeSend: function (xhr) {

                    },
                    success: function (data) {
                        var HTML = '<div id="msg_div" class="alert alert-success"><a class="close" data-dismiss="alert">×</a>';
                        HTML += '<strong>Success!</strong>Selected portfolio successfully mark as deleted!</div>';
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


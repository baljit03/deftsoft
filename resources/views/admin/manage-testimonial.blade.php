@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Testimonial</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage Testimonial
                </div>
                <a href="{{url('admin/add-new-testimonial')}}">Add New Testimonial</a>
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
                                <th>Client Image</th>
                                <th> Name</th>
                                <th>Address</th>
                                <th>Feedbacks</th>
                                <th>Testimonial </th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($dataArray["testimonialData"])>0)
                            @foreach($dataArray["testimonialData"] as $key=>$val)
                            <?php
                            $clientImg = "";
                            if (isset($val->client_profilImg) && !empty($val->client_profilImg)) {
                                $userImg = '300x223_' . $val->client_profilImg;
                            } else {
                                $userImg = "default-img.png";
                            }
                            ?>
                            <tr class="gradeX">
                                <td><img src="{{url('uploads/client-profile-img/'.$userImg)}}" height="80" width="80"/></td>
                                <td>{{$val->client_name}}</td>
                                <td>{{strip_tags($val->client_address)}}</td>
                                <td>{{strip_tags(substr($val->feedbacks,0,150))}}</td>
                                <td>{{ucfirst(ucfirst($val->testimonial_type))}}</td>
                                <td>{{ucfirst($val->status)}}</td>
                                <td>{{date("Y-m-d H:i:s",strtotime($val->created_at))}}</td>
                                <td><a href="{{url('/admin/manage-testimonial-detail/'.$val->id)}}" >Edit</a></td>
                                <td><a href="javascript:void(0);" class="deleteTestimonial" data-testimonialId="{{$val->id}}">Delete</a></td>
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
        $("body").on("click", ".deleteTestimonial", function () {
            var me = $(this);
            var index = $(".deleteTestimonial").index(me);
            var testimonialId = me.attr("data-testimonialId");
            var check = confirm("Are you sure want to delete?");
            var dataString = "testimonialId=" + testimonialId + "&_token={{csrf_token()}}";
            if (check == true) {
                $.ajax({
                    data: dataString,
                    url: "delete-testimonial",
                    type: "POST",
                    beforeSend: function (xhr) {

                    },
                    success: function (data) {
                        var HTML = '<div id="msg_div" class="alert alert-success"><a class="close" data-dismiss="alert">×</a>';
                        HTML += '<strong>Success!</strong>Selected testimonial successfully mark as deleted!</div>';
                        $("#mainMessageDv").html(HTML);
                        setTimeout(function () {
                            me.parent().parent().remove();
//                            window.location.reload();
                        }, 3000);
                    }
                });
            }
        });
    });
</script>
<!-------Datatables Queries------->
@endsection


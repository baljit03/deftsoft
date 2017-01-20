@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">System Setting</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    System Setting
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
                <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
                <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

                <div class="panel-body">

                    <div style="float:right"><p style="display: inline-block;">Maintenance Mode:</p>
                        <input type="checkbox" id="maintainCheck" data-toggle="toggle" <?php echo isset($dataArray["maintanceData"][0]->value) && $dataArray["maintanceData"][0]->value == '1' ? 'checked="checked"' : ''; ?>  data-on="Enable" data-off="Disable">
                    </div>

                    <script>
                        $(function () {
                            $('#toggle-two').bootstrapToggle({
                                on: 'Enable',
                                off: 'Disable'
                            });
                        })
                    </script>
                    <table id=""  width="100%" class="table table-striped table-bordered table-hover" id="myTable">
                        <thead>
                            <tr>

                                <th>Setting Name</th>
                                <th>Value</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($dataArray["settingData"] as $key=>$val)

                            <tr>
                                <td>{{ucfirst(str_replace("_"," ",$val->key))}}</td>
                                <td>{{$val->value}}</td>
                                <td>
                                    @if($val->setting_type == 'image')  
                                    <img src="{{url("uploads/systemImg/".$val->extra_info)}}" height="60" width="250"/>
                                    @else
                                    {{$val->extra_info}}
                                    @endif
                                </td>
                                <td>{{$val->status}}</td>
                                <td><a href="{{url('admin/updateSetting/'.$val->id)}}">Edit</a></td>
                            </tr>
                            @endforeach

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
        $("body").on("change", "#maintainCheck", function () {
            var me = $(this);
            var data = 0;
            if (me.is(":checked")) {
                var data = 1;
            }
            var dataString = "data=" + data + "&_token={{csrf_token()}}";
            $.ajax({
                data: dataString,
                url: "save-maintaince-mode",
                type: "POST",
                success: function () {
                    var HTML = '<div id="msg_div" class="alert alert-success"><strong>Success!</strong>Setting Saved Successfully</div>';
                        $("#mainMessageDv").html(HTML);
                    setTimeout(function(){
                         $("#mainMessageDv").html('');
                    },3000);
                }

            })


        });
    });
</script>
<!-------Datatables Queries------->
@endsection


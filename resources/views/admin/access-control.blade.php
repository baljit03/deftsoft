@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Access Control</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Access Management
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
                <div class="panel-body">
                    <form action="{{url('admin/access-management')}}" name="access_control_form" method="post" id="access_control_form">
                        <table>
                            <tr>
                                <th>Access Control</th>
                                <th>Admin User</th>
                                <th>Other User</th>
                            </tr>
                            <tr>
                                <th>Blog Management</th>
                                <td>
                                    <input type="checkbox" <?php echo in_array('blog', $dataArray["adminData"]) ? 'checked="checked"' : ''; ?>  value="1" name="blog_admin" />
                                </td>
                                <td>
                                    <input type="checkbox" <?php echo in_array('blog', $dataArray["userData"]) ? 'checked="checked"' : ''; ?> value="1" name="blog_other" />
                                </td>
                            </tr>
                            <tr>
                                <th>Pages Management</th>
                                <td> 
                                    <input type="checkbox" <?php echo in_array('pages', $dataArray["adminData"]) ? 'checked="checked"' : ''; ?> value="1" name="page_admin" />
                                </td>
                                <td>
                                    <input type="checkbox" <?php echo in_array('pages', $dataArray["userData"]) ? 'checked="checked"' : ''; ?> value="1" name="page_other" />
                                </td>
                            </tr>
                            <tr>
                                <th>User Management</th>
                                <td>
                                    <input type="checkbox" <?php echo in_array('users', $dataArray["adminData"]) ? 'checked="checked"' : ''; ?>  value="1" name="user_admin" />
                                </td>
                                <td>
                                    <input type="checkbox"  <?php echo in_array('users', $dataArray["userData"]) ? 'checked="checked"' : ''; ?> value="1" name="user_other" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                </td>
                                <td>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                    <input type="submit"  value="Save" />
                                </td>
                            </tr>
                        </table>
                    </form>
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
                    success: function () {

                    }

                });
            }
        });


    });
</script>
<!-------Datatables Queries------->
@endsection


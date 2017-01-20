@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
@include('admin.leftMenu')


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Profile</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Change Password
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
                        <form action="{{url('admin/update-password')}}"  method="post" name="change_pass_form" id="change_pass_form">
                            <fieldset>
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input class="form-control" type="password" name="old_password" value="">
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input class="form-control" type="password" id="new_password" name="new_password" value="">
                                </div>
                                <div class="form-group">
                                    <label>Re-enter password</label>
                                    <input class="form-control" type="password" name="re_password" value="">
                                </div>
                                <input  name="_token" type="hidden" value="{{csrf_token()}}">

                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-primary btn-block" id="change_btn" value="Change Password"/>
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
<script>
    $(document).ready(function () {
        $.validator.addMethod("lettersonly", function (value, element) {
            return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Letters only please");
        $("body").on("click", "#change_btn", function () {
            var me = $(this);
            $("#change_pass_form").validate({
                rules: {
                    old_password: {
                        required: true
                    },
                    new_password: {
                        required: true,
                        minlength: 6
                    },
                    re_password: {
                        required: true,
                        equalTo: "#new_password"
                    }
                },
                messages: {
                    old_password: {
                        required: "Please enter old password"
                    },
                    new_password: {
                        required: "Please enter new password",
                        minlength: "Password must be at least 6 characters long"
                    },
                    re_password: {
                        required: "Please re-enter password",
                        equalTo: "Password confirm password must be same"
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    });

</script>

<!-------Datatables Queries------->
@endsection


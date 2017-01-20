@extends('admin.master')
@section('title', 'Admin | Deftsoft')
@section('content')
 

<h3>Access Denied!</h3>
<a href="javascript:void(0);" onclick="goBack()">Go Back</a>
<!-------Datatables Queries------->
<script>
function goBack() {
    window.history.back();
}
</script>
@endsection


@extends('backends.backend')
@section('header')
    <title>@{{ title }}</title>
@endsection
@section('breadscrumb')
    <section class="content-header">
        <h1>
            Index
            <small>Change Password</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Change Password</li>
        </ol>
    </section>
@endsection
@section('content')
    <index-changepassword></index-changepassword>
@endsection
@section('script')
    <script type="text/javascript">
    </script>
@endsection
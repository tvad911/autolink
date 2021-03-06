@extends('backends.backend')
@section('header')
    <title>@{{ title }}</title>
@endsection
@section('breadscrumb')
    <section class="content-header">
        <h1>
            Index
            <small>Edit Profile</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Edit Profile</li>
        </ol>
    </section>
@endsection
@section('content')
    <index-editprofile></index-editprofile>
@endsection
@section('script')
    <script type="text/javascript">
    </script>
@endsection
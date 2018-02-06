@extends('backends.backend')
@section('header')
    <title>@{{ title }}</title>
@endsection
@section('breadscrumb')
    <section class="content-header">
        <h1>
            Index
            <small>User</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User</li>
        </ol>
    </section>
@endsection
@section('content')
	<index-user></index-user>
@endsection
@section('script')
    <script type="text/javascript">
    </script>
@endsection
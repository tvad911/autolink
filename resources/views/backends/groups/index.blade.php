@extends('backends.backend')
@section('header')
    <title>@{{ title }}</title>
@endsection
@section('breadscrumb')
    <section class="content-header">
        <h1>
            Index
            <small>Group</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Group</li>
        </ol>
    </section>
@endsection
@section('content')
    <index-group></index-group>
@endsection
@section('script')
    <script type="text/javascript">
    </script>
@endsection
@extends('backends.backend')
@section('header')
    <title>@{{ title }}</title>
@endsection
@section('breadscrumb')
    <section class="content-header">
        <h1>
            Index
            <small>Api Shortest Url</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Api Shortest Url</li>
        </ol>
    </section>
@endsection
@section('content')
    <index-apishortesturl></index-apishortesturl>
@endsection
@section('script')
    <script type="text/javascript">
    </script>
@endsection
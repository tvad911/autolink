@extends('auth.app')

@section('content')
    <div class="login-box-body">
        <p class="login-box-msg">Register Password</p>

        <form action="{{ url('password/email') }}" method="post">
            {!! csrf_field() !!}
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-5">
                </div>
                <!-- /.col -->
                <div class="col-xs-7">
                    <button type="submit" class="btn btn-primary btn-block btn-flat"> Send your Passwork reset link</button>
                </div>
                <!-- /.col -->
            </div>
            </br>
        </form>
    </div><!-- /.login-box-body -->
@endsection
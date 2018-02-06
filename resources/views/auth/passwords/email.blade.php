@extends('auth.app')

@section('content')
    <div class="register-box-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <p class="login-box-msg">Reset Password</p>

        <form action="{{ url('password/email') }}" method="post">
            {!! csrf_field() !!}
            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-4">
                </div>
                <!-- /.col -->
                <div class="col-xs-8">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Send Reset Passwork Link</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google</a>
        </div>
        <!-- /.social-auth-links -->

        <a href="{{ url('/login') }}" class="text-center">I already have a membership</a>
    </div><!-- /.form-box -->
@endsection
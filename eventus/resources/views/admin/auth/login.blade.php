@extends('layouts.admin')

@section('content')
<div class="login-outer">
<div class="login-inner">
        <div class="admin-login">
                <div class="row">
                <div class="col-sm-6">
                     <div class="logo">{{ Html::image('public/images/admin/logo.png') }}
                     </div>
                 </div>
                 <div class="col-sm-6">
                    <div class="panel panel-default login-panel">
                        <div class="panel-heading">Login to your account</div>
                        <div class="panel-body">
                             <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/login') }}">
                                {!! csrf_field() !!}
        
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                   
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email">
        
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    
                                </div>
        
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    
                                        <input type="password" class="form-control" name="password"  placeholder="password">
        
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                   
                                </div>
        
                                <div class="form-group">
                                    
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember"> Remember Me
                                            </label>
                                        
                                    </div>
                                </div>
        
                                <div class="form-group">
                                 <a class="btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                   <!--<a class="btn-link" href="#">Forgot Your Password?</a>-->
                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-btn fa-sign-in"></i>Login
                                        </button>
        
                                        
                                 
                                </div>
                            </form></div>
                    </div>
                </div>
              
            </div>  <h6 class="copyright">&copy; </h6>
        </div>
        </div>
</div>
@endsection

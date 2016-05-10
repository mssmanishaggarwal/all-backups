@extends('layouts.app')
@section('script')
@endsection
@section('content')

<section class="signupmain" >
    <div class="container" >

        <h2><span>F</span>ORGATE PASSWORD</h2>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal login clearfix" role="form" method="POST" action="{{ url('/password/email') }}">
                        {!! csrf_field() !!}

                        <div class="col-md-12 m-b-15 email  form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="row">

                    <div class="col-md-12 col-sm-12">
                        <label for="email-mob">Email<span>*</span></label>
                        <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" required="">

                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                        </div>

                        <div class="col-md-6 m-b-35">
                <input type="submit" class="btn btn-primary orange" value="Send Password Reset Link">

            </div>
                    </form>
    </div>
</section>

@endsection

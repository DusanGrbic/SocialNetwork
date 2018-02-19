@extends('templates.master')

@section('content')
<h3>Create an Account</h3>
<div class="row">
    <div class="col-md-5">
        <br>
        <form action="{{ route('auth.signup') }}" method="POST">
            {{ csrf_field() }}
            
            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                <label class="control-label">First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{ request()->old('first_name') }}">
                @if($errors->has('first_name'))
                    <span class="help-block">{{ $errors->first('first_name') }}</span>
                @endif
            </div>
            
            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                <label class="control-label">Last Name</label>
                <input type="text" name="last_name" class="form-control"  value="{{ request()->old('last_name') }}">
                @if($errors->has('last_name'))
                    <span class="help-block">{{ $errors->first('last_name') }}</span>
                @endif
            </div>
            
            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                <label class="control-label">Address</label>
                <input type="text" name="address" class="form-control"  value="{{ request()->old('address') }}">
                @if($errors->has('address'))
                    <span class="help-block">{{ $errors->first('address') }}</span>
                @endif
            </div>
            
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label>Email <small><i>(required)</i></small></label>
                <input type="email" name="email" class="form-control" required  value="{{ request()->old('email') }}">
                @if($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>
            
            <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                <label>Username <small><i>(required)</i></small></label>
                <input type="text" name="username" class="form-control" required  value="{{ request()->old('username') }}">
                @if($errors->has('username'))
                    <span class="help-block">{{ $errors->first('username') }}</span>
                @endif
            </div>
            
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label class="control-label">Password <small><i>(required)</i></small></label>
                <input type="password" name="password" class="form-control" required>
                @if($errors->has('password'))
                    <span class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>
            
            <div class="form-group">
                <label class="control-label">Repeat Password <small><i>(required)</i></small></label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Sign Up">
            </div>
        </form>
        <br>
    </div>
</div>
@endsection
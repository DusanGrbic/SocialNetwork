@extends('templates.master')

@section('content')
<h3>Sign In</h3>
<div class="row">
    <div class="col-md-5">
        <br>
        
        <form action="{{ route('auth.signin') }}" method="POST">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label class="control-label">Email</label>
                <input type="email" name="email" class="form-control" required 
                       value="{{ session('email') }}">
            </div>
            
            <div class="form-group">
                <label class="control-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            <div class="form-group">
                <input type="checkbox" name="remember"> Remember Me
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Sign In">
            </div>
        </form>
    </div>
</div>
@endsection


@extends('templates.master')

@section('content')
<h3>Update Your Profile</h3>
<div class="row">
    <div class="col-md-5">
        <form action="{{ route('profile.edit') }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                <label class="control-label">First Name</label>
                <input type="text" name="first_name" class="form-control" 
                       value="{{ request()->old('first_name') ? : auth()->user()->first_name }}">
                @if($errors->has('first_name'))
                    <span class="help-block">{{ $errors->first('first_name') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                <label class="control-label">Last Name</label>
                <input type="text" name="last_name" class="form-control"  
                       value="{{ request()->old('last_name') ? : auth()->user()->last_name }}">
                @if($errors->has('last_name'))
                    <span class="help-block">{{ $errors->first('last_name') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                <label class="control-label">Address</label>
                <input type="text" name="address" class="form-control"  
                       value="{{ request()->old('location') ? : auth()->user()->location }}">
                @if($errors->has('address'))
                    <span class="help-block">{{ $errors->first('address') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label>Email <small><i>(required)</i></small></label>
                <input type="email" name="email" class="form-control" required  
                       value="{{ request()->old('email') ? : auth()->user()->email }}">
                @if($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                <label>Username <small><i>(required)</i></small></label>
                <input type="text" name="username" class="form-control" required  value="{{ auth()->user()->username }}">
                @if($errors->has('username'))
                    <span class="help-block">{{ request()->old('username') ? : $errors->first('username') }}</span>
                @endif
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update">
            </div>
        </form>
    </div>
</div>
@endsection


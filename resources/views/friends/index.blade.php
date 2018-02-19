@extends('templates.master')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h3>Your Friends</h3>
        @if(!$friends->count())
            <p>You dont have any friends yet. Go and make some!</p>
        @else
            @foreach($friends as $user)   
                @include('user.userblock')
            @endforeach
        @endif
    </div>
    
    <div class="col-md-offset-2 col-md-4">
        <h4>Friend Requests</h4>
        @if(!$friend_requests_received->count())
            <p>No friend requests received</p>
        @else
            @foreach($friend_requests_received as $user)   
                @include('user.userblock')
            @endforeach
        @endif
    </div>
</div>
@endsection


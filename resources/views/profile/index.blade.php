@extends('templates.master')

@section('scripts')
<script>
    var user = <?php echo $user->toJson() ?>
</script>
@endsection

@section('content')
<div class="row">
    <div class="col-md-5">
        @include('user.userblock')
        
        <hr>
        
        @if(!count($statuses))
            {{ $user->username }} hasnt't posted anything yet
        @else
            @foreach($statuses as $status)   
                @include('templates.partials.profile_status')
            @endforeach
        @endif
    </div>
    
    <div class="col-md-offset-4 col-md-3">
        @if(auth()->user()->has_friend_request_received($user))
            <a href="{{ route('friends.accept', [ 'username' => $user->username ]) }}" class="btn btn-success">
                Accept Friend Request
            </a>
        
        @elseif(auth()->user()->has_friend_request_pending($user))
            <p>Waiting for {{ $user->username }} to accept your request</p>
            
        @elseif(auth()->user()->is_friends_with($user))
            <p>You and {{ $user->username }} are friends</p>
            
            <form action="{{ route('friends.delete', $user->id) }}" method="POST">
                {{ csrf_field() }}
                <input type="submit" class="btn btn-danger btn-sm" value="Delete Friend"
                       onclick="return confirm('Are you sure you want to remove ' + user.username + ' from friends?')">
            </form>
            <hr>
            
        @elseif(Auth::user()->id !== $user->id)
            <a href="{{ route('friends.add', [ 'username' => $user->username ]) }}" class="btn btn-success">
                Add as Friend
            </a>
        @endif
        
        <h4>{{ $user->username }}'s friends</h4>
        @if(!$user->friends()->count())
            <p>{{ $user->username }} has no friends yet</p>
        @else
            @foreach($user->friends() as $user)   
                @include('user.userblock')
            @endforeach
        @endif
    </div>
</div>
@endsection







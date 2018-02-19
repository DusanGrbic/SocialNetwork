<div class="media">
    <a href="{{ route('profile.index', [ 'username' => $status->user->username ]) }}" class="pull-left">
        <img class="media-object" src="{{ $status->user->get_avatar_url() }}">
    </a>

    <div class="media-body">
        <h4 class="media-heading" >
            <a href="{{ route('profile.index', [ 'username' => $status->user->username ]) }}">
                {{ $status->user->username }}
            </a>
        </h4>

        <p>{{ $status->body }}</p>

        <ul class="list-inline">
            <li>{{ $status->created_at->diffForHumans() }}</li>
            @if(auth()->id() !== $status->user->id)
                <li><a href="{{ route('status.like', $status->id) }}">Like</a></li>
            @endif
            <li>{{ $likes = $status->likes()->count() }} {{ str_plural('like', $likes) }}</li>
        </ul>
        
        @foreach($status->replies as $reply)   
            @include('templates.partials.timeline_reply')
        @endforeach
        
        <form action="{{ route('status.reply', $status->id) }}" method="POST">
            {{ csrf_field() }}
            
            <div class="form-group {{ $errors->has("reply-$status->id") ? 'has-error' : '' }}">
                <textarea name="reply-{{ $status->id }}" class="form-control" rows="2" placeholder="Reply to this status"
                          >{{ request()->old("reply-$status->id") ? : '' }}</textarea>
                @if($errors->has("reply-$status->id"))
                    <span class="help-block">{{ $errors->first("reply-$status->id") }}</span>
                @endif
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-default btn-sm" value="Reply">
            </div>
        </form>
    </div>
</div>


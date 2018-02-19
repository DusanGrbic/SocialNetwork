<div class="media">
    <a href="{{ route('profile.index', [ 'username' => $status->user->username ]) }}" class="pull-left">
        <img src="{{ $status->user->get_avatar_url() }}" class="media-object">
    </a>

    <div class="media-body">
        <h4 class="media-heading">
            <a href="{{ route('profile.index', [ 'username' => $status->user->username ]) }}">
                {{ $status->user->username }}
            </a>
        </h4>

        <p>{{ $status->body }}</p>

        <ul class="list-inline">
            <li>{{ $status->created_at->diffForHumans() }}</li>
            @if(auth()->id() !== $user->id)
                <li><a href="{{ route('status.like', $status->id) }}">Like</a></li>
            @endif
            <li>{{ $likes = $status->likes()->count() }} {{ str_plural('like', $likes) }}</li>
        </ul>

        @foreach($status->replies as $reply)   
            @include('templates.partials.profile_reply')
        @endforeach

        @if($auth_user_is_friend || auth()->id() === $user->id)
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
        @endif

    </div>
</div>


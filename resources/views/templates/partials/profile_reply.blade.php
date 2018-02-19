<div class="media">
    <a href="{{ route('profile.index', [ 'username' => $reply->user->username ]) }}" class="pull-left">
        <img class="media-object" src="{{ $reply->user->get_avatar_url() }}" >
    </a>

    <div class="media-body">
        <h5 class="media-heading">
            <a href="{{ route('profile.index', [ 'username' => $reply->user->username ]) }}">
                {{ $reply->user->username }}
            </a>
        </h5>

        <p>{{ $reply->body }}</p>

        <ul class="list-inline">
            <li>{{ $reply->created_at->diffForHumans() }}</li>
            @if(auth()->id() !== $reply->user->id)
                <li><a href="{{ route('status.like', $reply->id) }}">Like</a></li>
            @endif
            <li>{{ $likes = $reply->likes()->count() }} {{ str_plural('like', $likes) }}</li>
        </ul>
    </div>
</div>




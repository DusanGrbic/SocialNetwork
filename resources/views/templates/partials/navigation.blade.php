<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">Chatty</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @if(Auth::check())
            <ul class="nav navbar-nav">
                <li><a href="{{ route('timeline.index') }}">Timeline</a></li>
                <li><a href="{{ route('friends.index') }}">Friends</a></li>
            </ul>
            
            <form class="navbar-form navbar-left" action="{{ route('search.results') }}">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Find People" name="query">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
            @endif
            
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li><a href="{{ route('profile.index', [ 'username' => auth()->user()->username ]) }}">{{ auth()->user()->username }}</a></li>
                    <li><a href="{{ route('profile.edit') }}">Update Profile</a></li>
                    <li><a href="{{ route('auth.logout') }}">Sign Out</a></li>
                @else
                    <li><a href="{{ route('auth.signin') }}">Sign In</a></li>
                    <li><a href="{{ route('auth.signup') }}">Sign Up</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


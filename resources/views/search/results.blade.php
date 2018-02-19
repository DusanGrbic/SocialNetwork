@extends('templates.master')

@section('content')
<h3>You searched for: {{ request()->input('query') }}</h3>
<hr>
<div class="row">
    <div class="col-md-6">
        @if(!$users->count())
            <p>No results found</p>
        @else
            @foreach($users as $user)   
                @include('user.userblock')
            @endforeach
        @endif
        
    </div>
</div>
@endsection


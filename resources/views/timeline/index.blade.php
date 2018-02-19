@extends('templates.master')

@section('content')
<div class="row">
    <div class="col-md-5">
        <form action="{{ route('status.post') }}" method="POST">
            {{ csrf_field() }}
            
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <textarea name="status" class="form-control" rows="3"
                          placeholder="What's up {{ auth()->user()->username }}?"></textarea>
                @if($errors->has('status'))
                    <span class="help-block">{{ $errors->first('status') }}</span>
                @endif
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-default" value="Update Status">
            </div>
        </form>
        
        <hr>
        
        @if(!count($statuses))
            <p>There's nothing in your timeline yet</p>
        @else
            @foreach($statuses as $status)   
                @include('templates.partials.timeline_status')
            @endforeach
            {{ $statuses->links() }}
        @endif
    </div>
</div>
@endsection


<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function post_status(Request $request) {
        $this->validate($request, [
            'status' => 'required|max:1000'
        ]);
        
        auth()->user()->post_status($request->status);

        return back()->with('info', 'Status Posted');
    }
    
    public function post_reply(Request $request, $status_id) {
        $this->validate($request, [
            'reply-' . $status_id => 'required|max:1000'
        ], [
        'required' => 'The reply body is required',
        'max' => 'Maximum of 1000 characters is allowed'
        ]);
        
        $status = Status::findOrFail($status_id);
        
        if (!auth()->user()->is_friends_with($status->user) && auth()->id() !== $status->user->id) {
            return redirect()->route('home');
        }
        
        $status->replies()->create([
            'body' => $request->input("reply-$status->id"),
            'user_id' => auth()->id()
        ]);
        
        return back();
    }
    
    public function get_like($status_id) {
        $status = Status::findOrFail($status_id);
        
        if (auth()->user()->has_liked_status($status)) {
            return back()->with('info', 'You have already liked that status before');
        }
        
        $status->likes()->create([
            'user_id' => auth()->id()
        ]);
        
        return back();
    }
}

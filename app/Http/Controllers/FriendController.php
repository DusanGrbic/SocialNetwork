<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function get_index() {
        $friends = auth()->user()->friends();
        $friend_requests_received = auth()->user()->friend_requests_received();

        return view('friends.index')
                ->with('friends', $friends)
                ->with('friend_requests_received', $friend_requests_received);
    }
    
    public function get_add($username) {
        $user = User::where('username', $username)->first();
        
        if (!$user) {
            abort(404);
        }
        
        if (auth()->user()->id === $user->id) {
            return redirect()->route('home')->with('danger', 'You cant be friend with yourself!');
        }
        
        if (auth()->user()->has_friend_request_received($user) || auth()->user()->has_friend_request_pending($user)) {
            return redirect()->route('profile.index', ['username' => $user->username])
                    ->with('info', 'Friend request already pending');
        }
        
        if (auth()->user()->is_friends_with($user)) {
            return redirect()->route('profile.index', ['username' => $user->username])
                            ->with('info', 'You are already friends');
        }
        
        auth()->user()->add_friend($user);
        
        return redirect()->route('profile.index', ['username' => $user->username])
                        ->with('info', 'Friend request sent');
    }
    
    public function get_accept($username) {
        $user = User::where('username', $username)->first();
        
        if (!$user) {
            abort(404);
        }
        
        if (!auth()->user()->has_friend_request_received($user)) {
            return redirect()->route('home')->with('danger', 'Stop That!');
        }
        
        auth()->user()->accept_friend($user);
        
        return redirect()->route('friends.index', [ 'username' => $user->username ])
                ->with('info', 'Friend request accepted');
    }
    
    public function post_delete($id) {
        $user = User::findOrFail($id);
        
        if (!auth()->user()->is_friends_with($user)) {
            return back();
        }
        
        auth()->user()->delete_friend($user);
        
        return back()->with('info', 'Friend Deleted');
    }
}

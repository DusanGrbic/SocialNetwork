<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function get_index($username) {
        $user = User::where('username', $username)->first();

        if (!$user) {
            abort(404);
        }
        
        $statuses = $user->statuses()->not_reply()->get();

        return view('profile.index')
                ->with('user', $user)
                ->with('statuses', $statuses)
                ->with('auth_user_is_friend', $user->is_friends_with(auth()->user()));
    }
    
    public function get_edit() {
        return view('profile.edit');
    }
    
    public function post_edit(Request $request) {
        $this->validate($request, [
            'first_name' => 'nullable|regex:/^[\pL\s\-]+$/u|max:191',
            'last_name' => 'nullable|regex:/^[\pL\s\-]+$/u|max:191',
            'address' => 'nullable|regex:/^[\pL\d\s\.\-_,]+$/u|max:191',
            'email' => 'required|email|unique:users,email,' . auth()->id() . '|max:191',
            'username' => 'required|regex:/^[\pL\d\s\.\-_]+$/u|unique:users,username,' . auth()->id() . '|max:191',
                ], [
            'first_name.regex' => 'Only letters and spaces are allowed',
            'last_name.regex' => 'Only letters and spaces are allowed',
            'address.regex' => 'Only letters, numbers, spaces, dots, dashes, commas and underscores are allowed',
            'username.regex' => 'Only letters, numbers, spaces, dots, dashes and underscores are allowed',
        ]);
        
        auth()->user()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'location' => $request->address,
            'email' => $request->email,
            'username' => $request->username,
        ]);
        
        return back()->with('info', 'Your profile has been updated');
    }

}

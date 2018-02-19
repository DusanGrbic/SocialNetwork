<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function get_signup() {
        return view('auth.signup');
    }
    
    public function post_signup(Request $request) {
        $this->validate($request, [
            'first_name' => 'nullable|regex:/^[\pL\s\-]+$/u|max:191',
            'last_name' => 'nullable|regex:/^[\pL\s\-]+$/u|max:191',
            'address' => 'nullable|regex:/^[\pL\d\s\.\-_,]+$/u|max:191',
            'email' => 'required|email|unique:users|max:191',
            'username' => 'required|regex:/^[\pL\d\s\.\-_]+$/u|unique:users|max:191',
            'password' => 'required|min:6|confirmed'
        ], [
            'first_name.regex' => 'Only letters and spaces are allowed',
            'last_name.regex' => 'Only letters and spaces are allowed',
            'address.regex' => 'Only letters, numbers, spaces, dots, dashes, commas and underscores are allowed',
            'username.regex' => 'Only letters, numbers, spaces, dots, dashes and underscores are allowed',
        ]);
        
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'location' => $request->address,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);
        
        auth()->login($user);
        
        return redirect()->route('home')->with('info', 'Welcome to the chat ' . auth()->user()->username);
    }
    
    public function get_signin() {
        return view('auth.signin');
    }
    
    public function post_signin(Request $request) {
        if (!auth()->attempt(
                    $request->only([ 'email', 'password' ]), $request->has('remember')
        )) {
            return back()
                    ->with('danger', 'Could not sign you in with provided credentials!')
                    ->with('email', $request->email);
        }
        
        return redirect()->route('home')->with('info', 'You are signed in');
        
    }
    
    public function get_logout() {
        auth()->logout();
        return redirect()->route('home');
    }
}

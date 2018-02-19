<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function get_results(Request $request) {
        $query = $request->input('query');
        
        if (!$query) {
            return redirect()->route('home');
        }
        
        $raw = DB::raw('CONCAT(first_name, " ", last_name)');
        
        $users = User::where($raw, 'LIKE', "%$query%")
                ->orWhere('username', 'LIKE', "%$query%")
                ->get();
        
        return view('search.results')->with('users', $users);
    }
}

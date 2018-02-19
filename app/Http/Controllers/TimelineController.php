<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function get_index() {
//        $statuses = Status::where('user_id', auth()->id())
//                ->orWhereIn('user_id', auth()->user()->friends()->pluck('id'))
//                ->get();
        
        $statuses = Status::where(function ($query) {
            return $query->where('user_id', auth()->id())
                    ->orWhereIn('user_id', auth()->user()->friends()->pluck('id'));
        }) ->not_reply()
            ->latest()
            ->paginate(2);
        
        return view('timeline.index')->with('statuses', $statuses);
    }
}

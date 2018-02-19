<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likeable';
    protected $guarded = [];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function likeable() {
        return $this->morphTo();
    }
}

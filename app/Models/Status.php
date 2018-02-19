<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    protected $guarded = [];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
     public function scopeNot_reply($query) {
        return $query->whereNull('parent_id');
    }

    public function replies() {
        return $this->hasMany(Status::class, 'parent_id');
    }
    
    public function likes() {
        return $this->morphMany(Like::class, 'likeable');
    }

}

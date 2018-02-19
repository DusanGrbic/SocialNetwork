<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function get_avatar_url() {
        return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=mm&s=45";
    }
    
    
    /** Friends */
    public function friends_of_mine() {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }
    
    public function friend_of() {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id');
    }
    
    public function friends() {
        return $this->friends_of_mine()->wherePivot('accepted', true)->get()
                ->merge($this->friend_of()->wherePivot('accepted', true)->get());
    }
    
    public function friend_requests_received() {
        return $this->friend_of()->wherePivot('accepted', false)->get();
    }
    
    public function has_friend_request_received(User $user) {
        return (bool) $this->friend_requests_received()
                ->where('id', $user->id)
                ->count();
    }
    
    public function friend_requests_pending() {
        return $this->friends_of_mine()->wherePivot('accepted', false)->get();
    }
    
    public function has_friend_request_pending(User $user) {
        return (bool) $this->friend_requests_pending()
                ->where('id', $user->id)
                ->count();
    }
    
    public function is_friends_with(User $user) {
        return (bool) $this->friends()
                ->where('id', $user->id)
                ->count();
    }
    
    public function add_friend(User $user) {
        $this->friends_of_mine()->attach($user);
    }
    
    public function accept_friend(User $user) {
        $this->friend_requests_received()
                ->where('id', $user->id)
                ->first()
                ->pivot
                ->update([
                    'accepted' => true
                ]);
    }
    
    public function delete_friend(User $user) {
        $this->friends_of_mine()->detach($user);
        $this->friend_of()->detach($user);
    }
    
    
    /** Statuses */
    public function statuses() {
        return $this->hasMany(Status::class);
    }
    
    public function post_status($body) {
        $this->statuses()->create([
            'body' => $body
        ]);
    }
    
    public function has_liked_status(Status $status) {
        return (bool) $this->likes()->where('likeable_id', $status->id)->count();
    }
    
    public function likes() {
        return $this->hasMany(Like::class);
    }
    
}

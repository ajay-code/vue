<?php
namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [ 'body' ];

    protected $appends = ['likeCount', 'likedByCurrentUser', 'CanBeLikedByCurrentUser'];

    public function getLikeCountAttribute()
    {
    	return $this->likes->count();
    }

    public function getLikedByCurrentUserAttribute()
    {
    	return $this->likes->where('user_id', Auth::user()->id)->count() === 1;
    }

    public function getCanBeLikedByCurrentUserAttribute()
    {
        return $this->user_id !== Auth::user()->id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeLatestFirst($query)
    {
        $query->orderBy('created_at', 'desc');
    }

    

    public function likes()
    {
    	return $this->morphMany(Like::class, 'likeable');
    }
}

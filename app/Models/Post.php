<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\PostLikes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

     protected $fillable = [
        'title',
        'content',
        'image',
    ];

    protected $withCount = [
        'likes',
    ];
    public function likedBy(User $user){
        return $this->likes->contains('user_id', $user->id);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    // public function likes(){
    //     return $this->hasMany(Like::class);
    // }
    public function likes(): HasMany
{
    return $this->hasMany(PostLikes::class);
}
public function isLiked(): bool
{
    if (auth()->user()) {
        return auth()->user()->likes()->forPost($this)->count();
    }

    if (($ip = request()->ip()) && ($userAgent = request()->userAgent())) {
        return $this->likes()->forIp($ip)->forUserAgent($userAgent)->count();
    }

    return false;
}
    protected static function booted()
    {
        // We will automatically add the user to the post when it's saved.
        static::creating(function ($post) {
            if (auth()->user()) {
                $post->user_id = auth()->id();
            }
        });
    }
}

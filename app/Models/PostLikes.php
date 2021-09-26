<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostLikes extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ip',
        'user_agent',
    ];


public function removeLike(): bool
{
    if (auth()->user()) {
        return auth()->user()->likes()->forPost($this)->delete();
    }

    if (($ip = request()->ip()) && ($userAgent = request()->userAgent())) {
        return $this->likes()->forIp($ip)->forUserAgent($userAgent)->delete();
    }

    return false;
}

    public function scopeForPost($query, Post $post)
    {
        return $query->where('post_id', $post->id);
    }

    public function scopeForIp($query, string $ip)
    {
        return $query->where('ip', $ip);
    }

    public function scopeForUserAgent($query, string $userAgent)
    {
        return $query->where('user_agent', $userAgent);
    }

}

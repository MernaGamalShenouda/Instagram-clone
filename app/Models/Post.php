<?php

namespace App\Models;

// use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'images'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function isLiked($userId){
        return $this->likes()->where('user_id', $userId)->exists();

    }

    public function bookmarks()
    {
        return $this->hasMany(SavedPost::class);
    }
    public function isBookmarked($userId){
        return $this->bookmarks()->where('user_id', $userId)->exists();
    }

}

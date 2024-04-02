<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'username',
        'email',
        'password',
        'gender',
        'website',
        'bio',
        'avatar',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function updateAvatar($userId) {
        try {
            $user = User::findOrFail($userId);

            $cloudName = env('CLOUDINARY_CLOUD_NAME');

            if ($user->gender === 'female') {
                $avatarPublicId = 'Avatars/femaleAvatar_qraros';
            } else {
                $avatarPublicId = 'Avatars/maleAvatar_sdmi4s'; 
            }

            $avatarUrl = "https://res.cloudinary.com/{$cloudName}/image/upload/{$avatarPublicId}";
            $user->avatar = $avatarUrl;
            $user->save();
    
            return response()->json(['message' => 'User avatar updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating user avatar: ' . $e->getMessage()], 500);
        }
    }
}

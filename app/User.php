<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// class User extends Authenticatable
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','password','username','avatar', 'header_image', 'location', 'education','bio',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function deleteAvatarImage()
    {
        Storage::disk('s3')->delete($this->avatar);

    }

    public function deleteHeaderImage()
    {
        Storage::disk('s3')->delete($this->header_image);

    }
    public function isMember()
    {
        return $this->role_id === 4;
    }

    public function isWriter()
    {
        return $this->role_id === 3;
    }

    public function isAdmin()
    {
        return $this->role_id === 2;
    }

    public function isSuperAdmin()
    {
        return $this->role_id === 1;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    public function role()
    {
        return $this->belongsTo(UserRole::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    /**
     * check if user has skill
     *
     * @return bool
     *
     */

    public function hasSkill($skillId)
    {
        return in_array($skillId, $this->skills->pluck('id')->toArray());
    }
}

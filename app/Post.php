<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['title','description','content','image','imageUrl','published_at','category_id','user_id'];

    public function deleteImage()
    {
        Storage::disk('s3')->delete($this->image);

    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * check if post has tag
     *
     * @return bool
     *
     */

    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearched($query)
    {
        $search = request()->query('search');

        if (!$search) {
            return $query;
        }

        return $query->where('title', 'LIKE', "%{$search}%");
    }

    public function userPost()
    {
        $userID = Auth::user();
        return $this->post->where('user_id','Like', "%{$userID}%");
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $fillable = ['mimeType','path','url','post_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function deleteImage()
    {
        Storage::disk('s3')->delete($this->image);

    }
}

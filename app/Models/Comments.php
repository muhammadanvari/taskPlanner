<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable=['comment','name','blog_id','approved'];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}

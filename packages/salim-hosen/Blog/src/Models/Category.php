<?php

namespace SalimHosen\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SalimHosen\Core\Models\MediaUpload;

class Category extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'arabic_name',
        'category_id',
        "category_for",
        'slug',
        'image',
        "icon",
        "media_upload_id"
    ];

    public function parent(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function childs(){
        return $this->hasMany(Category::class, 'category_id');
    }

    public function posts(){
        return $this->belongsToMany(Post::class);
    }

    public function image(){
        return $this->belongsTo(MediaUpload::class, 'media_upload_id');
    }
}

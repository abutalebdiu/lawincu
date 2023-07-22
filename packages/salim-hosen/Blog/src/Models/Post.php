<?php

namespace SalimHosen\Blog\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SalimHosen\Core\Models\MediaUpload;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        // 'image',
        'media_upload_id',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'status',
        'content',
        'keywords',
        'short_description',
        'is_featured',
        'is_active',
        'slug',
        'published_at',
        'user_id'
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }


    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function image(){
        return $this->belongsTo(MediaUpload::class, 'media_upload_id');
    }
}



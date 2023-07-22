<?php

namespace SalimHosen\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tag_for',
        "slug"
    ];

    public function posts(){
        return $this->belongsTo(Post::class);
    }
}

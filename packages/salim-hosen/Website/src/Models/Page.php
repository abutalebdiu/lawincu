<?php

namespace SalimHosen\Website\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        "url",
        "language_code",
        "name",
        "title",
        "keywords",
        "description",
        "content",
        "is_active",
    ];

    public function contents(){
        return $this->hasMany(PageContent::class);
    }

}

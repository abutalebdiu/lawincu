<?php

namespace SalimHosen\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SalimHosen\Inventory\Models\Product;

class MediaUpload extends Model
{
    use HasFactory;
    protected $fillable = [

    ];

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}

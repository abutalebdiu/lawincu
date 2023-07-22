<?php

namespace SalimHosen\Website\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SalimHosen\Inventory\Models\Category;
use SalimHosen\Inventory\Models\Product;

class PageColumn extends Model
{
    use HasFactory;

    protected $fillable = [
        "page_row_id",
        "column_index",
        "class_name",
        "show_data",
        "data_type",
        "data",
        "is_active",
    ];

    public function rows(){
        return $this->hasMany(PageRow::class, 'page_column_id');
    }

    public function row(){
        return $this->belongsTo(PageRow::class, 'page_row_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'data');
    }

    public function featured_category(){
        return $this->belongsTo(Category::class, 'data');
    }
}

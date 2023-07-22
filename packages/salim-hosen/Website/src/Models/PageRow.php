<?php

namespace SalimHosen\Website\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageRow extends Model
{
    use HasFactory;

    protected $fillable = [
        "page_id",
        "row_index",
        "class_name",
        "is_active",
    ];


    public function columns(){
        return $this->hasMany(PageColumn::class);
    }

}

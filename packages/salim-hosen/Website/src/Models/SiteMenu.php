<?php

namespace SalimHosen\Website\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "arabic_name",
        "icon",
        "show_on_header",
        "show_on_footer",
        "url",
        "site_menu_id"
    ];


    public function submenu(){
        return $this->hasMany(SiteMenu::class, 'site_menu_id');
    }

}

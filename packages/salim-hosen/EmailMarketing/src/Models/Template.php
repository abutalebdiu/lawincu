<?php

namespace SalimHosen\EmailMarketing\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "content",
        "is_active",
        "company_id"
    ];


}

<?php

namespace SalimHosen\Support\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        "company_id",
        "first_name",
        "last_name",
        "email",
        "message"
    ];

}

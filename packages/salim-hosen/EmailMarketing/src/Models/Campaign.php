<?php

namespace SalimHosen\EmailMarketing\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        "company_id",
        "name",
        "subject",
        "from_name",
        "from_email",
        "reply_to",
        "content",
        "recipients"
    ];


}

<?php

namespace SalimHosen\Support\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "issue",
        "ticket",
        "attachment",
        "description",
        "status"
    ];


    public function replies(){
        return $this->hasMany(SupportTicketReply::class);
    }
}

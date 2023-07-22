<?php

namespace SalimHosen\Support\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicketReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'support_ticket_id',
        'attachment'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}

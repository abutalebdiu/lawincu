<?php

namespace SalimHosen\Support\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerQueryReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_for',
        'customer_query_id',
        'description',
    ];

    public function customer_query(){
        return $this->belongsTo(CustomerQuery::class);
    }

}

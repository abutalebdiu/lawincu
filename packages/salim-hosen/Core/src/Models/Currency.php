<?php

namespace SalimHosen\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "code",
        "symbol",
        "exchange_rate",
        "position",
        "is_active",
    ];
}

<?php

namespace SalimHosen\Core\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "url",
        "send_at",
        "notified_by"
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

}

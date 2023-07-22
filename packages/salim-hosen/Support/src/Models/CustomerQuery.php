<?php

namespace SalimHosen\Support\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SalimHosen\Core\Models\Company;

class CustomerQuery extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "company_id",
        "customer_query",
        // "attachment",
        "description",
        "is_seen"
    ];


    public function replies(){
        return $this->hasMany(CustomerQueryReply::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
}

<?php

namespace SalimHosen\EmailMarketing\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SalimHosen\Core\Models\Contact;

class MailingList extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "company_id",
        "mailing_list_id",
        "api_data"
    ];

    public function contacts(){
        return $this->belongsToMany(Contact::class);
    }

    public function mailing_list(){
        return $this->belongsTo(MailingList::class);
    }

    public function mailing_sublist(){
        return $this->hasMany(MailingList::class);
    }
}

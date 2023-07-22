<?php

namespace SalimHosen\Core\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SalimHosen\Core\Models\Contact;
use SalimHosen\EmailMarketing\Models\Sender;
use SalimHosen\Crm\Models\Lead;
use SalimHosen\Crm\Models\LeadSource;
use SalimHosen\Crm\Models\LeadStage;
use SalimHosen\Crm\Models\Pipeline;
use SalimHosen\EmailMarketing\Models\Campaign;
use SalimHosen\EmailMarketing\Models\MailingList;
use SalimHosen\EmailMarketing\Models\Subscriber;
use SalimHosen\EmailMarketing\Models\Template;
use SalimHosen\Inventory\Models\Product;
use SalimHosen\Core\Models\Zone;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "user_id",
        "company_id",
        "name",
        "main_products",
        "business_type",
        "number_of_employees",
        "year_of_establishment",
        "average_lead_time",
        "company_size",
        "company_description",
        "commercial_registration_number",
        "tax_number",
        "logo",
        // "trade_license",
        // "nid",
        "commercial_register_document",
        "slug",
        "is_approved",
        "is_active",
    ];

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('subrole_id');
    }

    public function contacts(){
        return $this->hasMany(Contact::class);
    }

    public function senders(){
        return $this->hasMany(Sender::class);
    }

    public function mailing_lists(){
        return $this->hasMany(MailingList::class);
    }

    public function campaigns(){
        return $this->hasMany(Campaign::class);
    }

    public function templates(){
        return $this->hasMany(Template::class);
    }

    public function subscribers(){
        return $this->hasMany(Subscriber::class);
    }

    public function leads(){
        return $this->hasMany(Lead::class);
    }

    public function lead_stages(){
        return $this->hasMany(LeadStage::class);
    }

    public function lead_sources(){
        return $this->hasMany(LeadSource::class);
    }

    public function pipelines(){
        return $this->hasMany(Pipeline::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function contact() {
        return $this->hasOne(Contact::class)->where('is_default_contact', true);
    }

    public function zones(){
        return $this->hasMany(Zone::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}

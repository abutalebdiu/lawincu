<?php

namespace SalimHosen\Crm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SalimHosen\Core\Models\Contact;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        "contact_id",
        "title",
        "lead_value",
        "lead_stage_id",
        // "lead_source_id",
        "company_id",
        "pipeline_id",
        "email",
        "phone",
        "expected_closing_date"
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function lead_stage()
    {
        return $this->belongsTo(LeadStage::class, 'lead_stage_id');
    }

    public function lead_source()
    {
        return $this->belongsTo(LeadSource::class, 'lead_source_id');
    }

}

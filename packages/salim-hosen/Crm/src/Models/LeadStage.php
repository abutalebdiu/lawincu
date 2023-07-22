<?php

namespace SalimHosen\Crm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadStage extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "pipeline_id",
        "company_id"
    ];

    public function pipeline(){
        return $this->belongsTo(Pipeline::class);
    }

    public function leads(){
        return $this->hasMany(Lead::class);
    }
}

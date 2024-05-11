<?php

namespace App\Models;

use App\Models\Consultation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FollowUpVaccine extends Model
{
    use HasFactory;
    protected $fillable = ['consultation_id','details','date','time','status'];

    public function consultation() :BelongsTo{
        return $this->belongsTo(Consultation::class);
    }
}

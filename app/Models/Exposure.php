<?php

namespace App\Models;

use App\Models\Treatment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exposure extends Model
{
    use HasFactory;
    protected $fillable = [
        "treatment_id",
        "date_of_incidence",
        "place_of_incidence",
        "animal_type",
        "animal_status",
        "type_of_bite",
        "washing_of_bite",
        "site_of_bite",
        "previous_vaccination",
        "status",
        "tissue_culture_vaccine",
        "rabies_immunoglobulin",
        "erig",
        "dose",
        "anti_titanus",
    ];

    public function treatment() :BelongsTo{
        return $this->belongsTo(Treatment::class);
    }
}

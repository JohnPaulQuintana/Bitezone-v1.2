<?php

namespace App\Models;

use App\Models\Exposure;
use App\Models\ScheduleOfVaccination;
use App\Models\SiteOfBite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Treatment extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "clinic_id",
        "firstname",
        "middlename",
        "lastname",
        "age",
        "gender",
        "date",
        "time",
        "record_number",
        "address",
        "place_of_birth",
        "contact_number",
        "chief_complain",
        "bp",
        "pr",
        "rr",
        "temp",
        "wt",
        "history_of_illness",
        "pertinent_pe",
        "diagnosis",
        "home_medicine",
    ];

    // has many siteOfBite
    public function bite() :HasOne{
        return $this->hasOne(SiteOfBite::class);
    }

    // has one exposure
    public function exposure() :HasOne{
        return $this->hasOne(Exposure::class);
    }

    // has one schedule
    public function schedule() :HasOne{
        return $this->hasOne(ScheduleOfVaccination::class);
    }

}

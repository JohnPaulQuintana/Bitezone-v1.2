<?php

namespace App\Models;

use App\Models\Booster;
use App\Models\Exposure;
use App\Models\PostExposure;
use App\Models\PreExposure;
use App\Models\ScheduleOfVaccination;
use App\Models\SiteOfBite;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Treatment extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "clinic_id",
        "consultation_id",
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
        "consultation_type",
    ];

    public function user() :BelongsTo{
        return $this->belongsTo(User::class);
    }

    // has many siteOfBite
    public function bite() :HasOne{
        return $this->hasOne(SiteOfBite::class);
    }

    // has one exposure
    public function exposure() :HasOne{
        return $this->hasOne(Exposure::class);
    }

    

    //has many post schedule
    public function post_exposure() :HasMany{
        return $this->hasMany(PostExposure::class);
    }
    //has many pre schedule
    public function pre_exposure() :HasMany{
        return $this->hasMany(PreExposure::class);
    }
    //has many pre schedule
    public function booster() :HasOne{
        return $this->hasOne(Booster::class);
    }
}

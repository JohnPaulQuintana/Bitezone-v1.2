<?php

namespace App\Models;

use App\Models\FollowUpVaccine;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','clinic_id' ,'consultation', 'status'];

    public function followup() :HasMany{
        return $this->hasMany(FollowUpVaccine::class);
    }

    public function user() :BelongsTo{
        return $this->belongsTo(User::class);
    }

    
}

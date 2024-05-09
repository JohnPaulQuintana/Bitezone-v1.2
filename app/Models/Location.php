<?php

namespace App\Models;

use App\Models\ClinicInformation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'lat', 'long', 'isDefined', 'address'];

    public function user() :BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function clinic() :HasOne{
        return $this->hasOne(ClinicInformation::class);
    }
}

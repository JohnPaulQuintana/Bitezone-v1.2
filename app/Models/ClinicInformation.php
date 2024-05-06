<?php

namespace App\Models;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClinicInformation extends Model
{
    use HasFactory;
    
    protected $fillable = ['location_id', 'profile', 'name', 'open','closed','days_of_week'];

    public function location() :BelongsTo{
        return $this->belongsTo(Location::class);
    }
}

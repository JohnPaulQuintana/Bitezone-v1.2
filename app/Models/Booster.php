<?php

namespace App\Models;

use App\Models\Treatment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booster extends Model
{
    use HasFactory;
    protected $fillable = ['treatment_id', 'booster_dose'];
    public function treatment() :BelongsTo{
        return $this->belongsTo(Treatment::class);
    }
}

<?php

namespace App\Models;

use App\Models\Treatment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SiteOfBite extends Model
{
    use HasFactory;
    protected $fillable = [
        'treatment_id',
        'site_of_bite',
    ];

    public function treatment() :BelongsTo{
        return $this->belongsTo(Treatment::class);
    }
}

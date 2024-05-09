<?php

namespace App\Models;

use App\Models\Treatment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostExposure extends Model
{
    use HasFactory;
    protected $fillable = ['treatment_id', 'day','date', 'time', 'site','rl','nod'];
    public function treatment() :BelongsTo{
        return $this->belongsTo(Treatment::class);
    }
}

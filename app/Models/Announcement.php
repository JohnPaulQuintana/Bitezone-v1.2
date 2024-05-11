<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','title','details','date','time','type','url','status'];

    public function user() :BelongsTo{
        return $this->belongsTo(User::class);
    }
}

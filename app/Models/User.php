<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Announcement;
use App\Models\Consultation;
use App\Models\Location;
use App\Models\Notification;
use App\Models\Treatment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'gender',
        'dateofbirth',
        'contact_no',
        'address',
        'email',
        'password',
        'isAdmin',
        'profile',
        'verified'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function location() :HasOne{
        return $this->hasOne(Location::class);
    }
    public function consultation() :HasMany{
        return $this->hasMany(Consultation::class);
    }
    public function treatment() :HasOne{
        return $this->hasOne(Treatment::class);
    }
    public function announcement() :HasMany{
        return $this->hasMany(Announcement::class);
    }
    public function notif() :HasMany{
        return $this->hasMany(Notification::class);
    }
}

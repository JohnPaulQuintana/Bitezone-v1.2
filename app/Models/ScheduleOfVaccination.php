<?php

namespace App\Models;

use App\Models\Treatment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduleOfVaccination extends Model
{
    use HasFactory;
    protected $fillable = [
        "treatment_id",
        "booster_dose",
        "post_day_0",
        "post_time_0",
        "post_site_0",
        "post_rl_0",
        "post_node_0",
        "post_day_3",
        "post_time_3",
        "post_site_3",
        "post_rl_3",
        "post_node_3",
        "post_day_7",
        "post_time_7",
        "post_site_7",
        "post_rl_7",
        "post_node_7",
        "post_day_14",
        "post_time_14",
        "post_site_14",
        "post_rl_14",
        "post_node_14",
        "post_day_28",
        "post_time_28",
        "post_site_28",
        "post_rl_28",
        "post_node_28",
        "pre_day_0",
        "pre_time_0",
        "pre_site_0",
        "pre_rl_0",
        "pre_node_0",
        "pre_day_7",
        "pre_time_7",
        "pre_site_7",
        "pre_rl_7",
        "pre_node_7",
        "pre_day_21",
        "pre_time_21",
        "pre_site_21",
        "pre_rl_21",
        "pre_node_21",
    ];

    public function treatment() :BelongsTo{
        return $this->belongsTo(Treatment::class);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_of_vaccinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treatment_id')->constrained()->onUpdate('cascade')->onDelete('cascade');//the treatment
            $table->string('booster_dose')->nullable();
            $table->date('post_day_0')->nullable();
            $table->time('post_time_0')->nullable();
            $table->text('post_site_0')->nullable();
            $table->string('post_rl_0')->nullable();
            $table->text('post_nod_0')->nullable();

            $table->date('post_day_3')->nullable();
            $table->time('post_time_3')->nullable();
            $table->text('post_site_3')->nullable();
            $table->string('post_rl_3')->nullable();
            $table->text('post_nod_3')->nullable();

            $table->date('post_day_7')->nullable();
            $table->time('post_time_7')->nullable();
            $table->text('post_site_7')->nullable();
            $table->string('post_rl_7')->nullable();
            $table->text('post_nod_7')->nullable();
            
            $table->date('post_day_14')->nullable();
            $table->time('post_time_14')->nullable();
            $table->text('post_site_14')->nullable();
            $table->string('post_rl_14')->nullable();
            $table->text('post_nod_14')->nullable();
            
            $table->date('post_day_28')->nullable();
            $table->time('post_time_28')->nullable();
            $table->text('post_site_28')->nullable();
            $table->string('post_rl_28')->nullable();
            $table->text('post_nod_28')->nullable();

            
            $table->date('pre_day_0')->nullable();
            $table->time('pre_time_0')->nullable();
            $table->text('pre_site_0')->nullable();
            $table->string('pre_rl_0')->nullable();
            $table->text('pre_nod_0')->nullable();
            
            $table->date('pre_day_7')->nullable();
            $table->time('pre_time_7')->nullable();
            $table->text('pre_site_7')->nullable();
            $table->string('pre_rl_7')->nullable();
            $table->text('pre_nod_7')->nullable();
            
            $table->date('pre_day_21')->nullable();
            $table->time('pre_time_21')->nullable();
            $table->text('pre_site_21')->nullable();
            $table->string('pre_rl_21')->nullable();
            $table->text('pre_nod_21')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_of_vaccinations');
    }
};

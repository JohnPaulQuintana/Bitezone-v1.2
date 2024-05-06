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
        Schema::create('clinic_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained();
            $table->text('profile');
            $table->string('name');
            $table->time('open');
            $table->time('closed');
            $table->json('days_of_week');
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
        Schema::dropIfExists('clinic_information');
    }
};

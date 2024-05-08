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
        Schema::create('exposures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treatment_id')->constrained()->onUpdate('cascade')->onDelete('cascade');//the treatment
            $table->date('date_of_incidence')->nullable();
            $table->text('place_of_incidence')->nullable();
            $table->string('animal_type')->nullable();
            $table->string('animal_status')->nullable();
            $table->string('type_of_bite')->nullable();
            $table->text('washing_of_bite')->nullable();
            $table->text('site_of_bite')->nullable();
            $table->date('previous_vaccination')->nullable();
            $table->string('status')->nullable();
            $table->string('tissue_culture_vaccine')->nullable();
            $table->string('rabies_immunoglobulin')->nullable();
            $table->string('erig')->nullable();
            $table->bigInteger('dose')->nullable();
            $table->string('anti_titanus')->nullable();
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
        Schema::dropIfExists('exposures');
    }
};

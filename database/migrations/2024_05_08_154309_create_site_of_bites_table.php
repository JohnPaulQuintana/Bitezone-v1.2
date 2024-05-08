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
        Schema::create('site_of_bites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treatment_id')->constrained()->onUpdate('cascade')->onDelete('cascade');//the treatment
            $table->json('site_of_bite');
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
        Schema::dropIfExists('site_of_bites');
    }
};

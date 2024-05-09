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
        Schema::create('post_exposures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treatment_id')->constrained()->onUpdate('cascade')->onDelete('cascade');//the treatment
            $table->string('day')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->text('site')->nullable();
            $table->string('rl')->nullable();
            $table->string('nod')->nullable();
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
        Schema::dropIfExists('post_exposures');
    }
};

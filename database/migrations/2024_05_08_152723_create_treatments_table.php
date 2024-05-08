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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');//the patients
            $table->unsignedBigInteger('clinic_id');//the physician id
            // basic information
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->bigInteger('age');
            $table->string('gender');
            $table->date('date');
            $table->time('time');
            $table->string('record_number');
            $table->text('address');
            $table->text('place_of_birth')->nullable();
            $table->text('contact_number');
            $table->text('chief_complain')->nullable();
            $table->string('bp')->nullable();
            $table->string('pr')->nullable();
            $table->string('rr')->nullable();
            $table->string('temp')->nullable();
            $table->string('wt')->nullable();
            $table->text('history_of_illness')->nullable();
            $table->text('pertinent_pe')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('home_medicine')->nullable();
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
        Schema::dropIfExists('treatments');
    }
};

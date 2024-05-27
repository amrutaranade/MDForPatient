<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferringPhysiciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referring_physicians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('institution')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('street_address')->nullable();
            $table->string('email')->nullable();
            $table->string('confirm_email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('fax_number')->nullable();
            $table->string('ip_address'); 
            $table->string('latitude'); 
            $table->string('longitude'); 
            $table->string('browser_agent'); 
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('patient_id')->references('id')->on('patients_registration_details')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referring_physicians');
    }
}

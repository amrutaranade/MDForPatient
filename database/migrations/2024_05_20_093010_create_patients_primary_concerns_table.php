<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsPrimaryConcernsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_primary_concerns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->string('primary_diagnosis')->nullable();
            $table->enum('treated_before', ['Yes', 'No'])->nullable();
            $table->text('surgery_description')->nullable();
            $table->text('request_description')->nullable();
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
        Schema::dropIfExists('patients_primary_concerns');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientExpertOpinionRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_expert_opinion_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->enum('agree_to_terms', ['Yes', 'No'])->nullable();
            $table->longText('cover_letter')->nullable();
            $table->longText('patient_agreement')->nullable();
            $table->text('sign_off')->nullable();
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
        Schema::dropIfExists('patient_expert_opinion_requests');
    }
}

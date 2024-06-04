<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactPartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_parties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->string('relationship_to_patient');  
            $table->string('email'); 
            $table->string('phone_number');
            $table->string('preferred_mode_of_communication'); 
            $table->string('preferred_contact_time')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable(); 
            $table->string('NPI')->nullable(); 
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();  
            $table->string('postal_code')->nullable();  
            $table->string('street_address')->nullable(); 
            $table->string('Instituton')->nullable();
            $table->string('fax_number')->nullable();
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
        Schema::dropIfExists('contact_parties');
    }
}

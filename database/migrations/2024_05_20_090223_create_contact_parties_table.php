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
            $table->longText('relationship_to_patient');  
            $table->longText('email'); 
            $table->longText('phone_number');
            $table->longText('preferred_mode_of_communication'); 
            $table->longText('preferred_contact_time')->nullable();
            $table->longText('first_name')->nullable();
            $table->longText('last_name')->nullable(); 
            $table->longText('NPI')->nullable(); 
            $table->longText('country')->nullable();
            $table->longText('state')->nullable();
            $table->longText('city')->nullable();  
            $table->longText('postal_code')->nullable();  
            $table->longText('street_address')->nullable(); 
            $table->longText('Instituton')->nullable();
            $table->longText('fax_number')->nullable();
            $table->longText('relationship_other')->nullable();
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsRegistrationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients_registration_details', function (Blueprint $table) {
            $table->id();
            $table->string('patient_consulatation_number');
            $table->string('first_name');
            $table->string('middle_name')->nullable();  
            $table->string('last_name'); 
            $table->string('email'); 
            $table->date('date_of_birth');  
            $table->enum('gender', ['Male', 'Female', 'Non-binary','Other'])->nullable(); 
            $table->string('country');
            $table->string('state');
            $table->string('city');  
            $table->string('postal_code');  
            $table->string('street_address'); 
            $table->softDeletes();
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
        Schema::dropIfExists('patients_registration_details');
    }
}

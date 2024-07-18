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
            $table->longText('patient_consulatation_number');
            $table->longText('first_name');
            $table->longText('middle_name')->nullable();  
            $table->longText('last_name'); 
            $table->longText('email'); 
            $table->longText('email_hash'); 
            $table->date('date_of_birth');  
            $table->enum('gender', ['Male', 'Female', 'Non-binary','Other'])->nullable(); 
            $table->longText('country');
            $table->longText('state');
            $table->longText('city');  
            $table->longText('postal_code');  
            $table->longText('street_address'); 
            $table->longText("is_registration_completed")->default("pending");
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

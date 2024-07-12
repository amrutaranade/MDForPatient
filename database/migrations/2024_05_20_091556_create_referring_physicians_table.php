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
            $table->longText('first_name')->nullable();
            $table->longText('last_name')->nullable();
            $table->longText('institution')->nullable();
            $table->longText('country')->nullable();
            $table->longText('state')->nullable();
            $table->longText('city')->nullable();
            $table->longText('postal_code')->nullable();
            $table->longText('street_address')->nullable();
            $table->longText('email')->nullable();
            $table->longText('confirm_email')->nullable();
            $table->longText('phone_number')->nullable();
            $table->longText('fax_number')->nullable();
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

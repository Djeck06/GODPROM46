<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('order_infos');
        Schema::create('order_appointments', function (Blueprint $table) {
           
                $table->id();

                $table->foreignId('order_id')
                    ->constrained()
                    ->cascadeOnUpdate();
                $table->string('appointment_code')->nullable();
                $table->dateTime('appointment_date')->nullable();
                $table->string('appointment_start')->default('09:00');
                $table->string('appointment_end')->default('18:00');
                
                $table->timestamps();
                $table->softDeletes();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickupTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickup_tasks', function (Blueprint $table) {
            $table->id();

            //$table->string('status')->nullable();

            $table->foreignId('transporter_id')
                ->constrained()
                ->cascadeOnUpdate();

            $table->foreignId('order_appointment_id')
                ->constrained()
                ->cascadeOnUpdate();
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
        Schema::dropIfExists('pickup_tasks');
    }
}

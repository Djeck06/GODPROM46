<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransporterTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transporter_tasks', function (Blueprint $table) {
            
            $table->id();

            $table->foreignId('order_appointment_id')
                ->constrained()
                ->cascadeOnUpdate();

            $table->foreignId('transporter_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate();

            $table->string('receipt_code')->nullable();
            $table->string('receipt_date');
            $table->string('rate')->nullable();
            $table->string('status')->nullable(); // in_progress | completed |
            
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
        Schema::dropIfExists('transporter_tasks');
    }
}

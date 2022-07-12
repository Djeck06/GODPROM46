<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageTransmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_transmissions', function (Blueprint $table) {
            $table->id();
           

            $table->foreignId('transporter_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate();

            $table->foreignId('docker_task_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate();

            $table->string('receipt_code')->nullable();
            $table->date('receipt_date');
            
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
        Schema::dropIfExists('package_transmissions');
    }
}

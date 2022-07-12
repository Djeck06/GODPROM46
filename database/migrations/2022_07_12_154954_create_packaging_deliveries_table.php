<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagingDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packaging_deliveries', function (Blueprint $table) {
            $table->id();
           

            $table->foreignId('transporter_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate();

            $table->foreignId('packaging_id')
                ->constrained()
                ->cascadeOnUpdate();

            $table->date('delivery_date')->nullable();
            $table->date('departure_date')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });

       
        Schema::dropIfExists('package_transmissions');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packaging_deliveries');
    }
}

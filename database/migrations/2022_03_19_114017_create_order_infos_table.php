<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('order_infos') ) {

            Schema::create('order_infos', function (Blueprint $table) {
                $table->id();

                $table->foreignId('order_id')
                    ->constrained()
                    ->cascadeOnUpdate();

                $table->foreignId('transporter_id')
                    ->nullable()
                    ->constrained()
                    ->cascadeOnUpdate();

                $table->dateTime('appointment_date')->nullable();
                $table->string('appointment_code')->nullable();

                $table->string('receiver_name')->nullable();
                $table->string('receiver_address')->nullable();
                $table->string('receiver_phone')->nullable();
                $table->string('receiver_email')->nullable();
                $table->text('receiver_comments')->nullable();

                $table->string('reception_code')->nullable();

                $table->string('order_rate')->nullable();
                


                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_infos');
    }
}

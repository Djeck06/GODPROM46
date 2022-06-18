<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPaymentPlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_payment_platforms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
                    ->constrained()
                    ->cascadeOnUpdate();

            $table->foreignId('payment_platform_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate();

            $table->string('account_number')->nullable();
            

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
        Schema::dropIfExists('client_payment_platforms');
    }
}

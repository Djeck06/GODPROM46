<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
                ->constrained()
                ->cascadeOnUpdate();

            $table->boolean('pickup_at_office')->default(false);
            $table->string('pickup_country')->nullable();
            $table->string('pickup_city')->nullable();
            $table->string('pickup_address')->nullable();

            $table->string('delivery_country')->nullable();
            $table->string('delivery_city')->nullable();
            $table->string('delivery_address')->nullable();

            $table->text('notes')->nullable();
            $table->string('status')->default('pending');

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
        Schema::dropIfExists('quotations');
    }
}

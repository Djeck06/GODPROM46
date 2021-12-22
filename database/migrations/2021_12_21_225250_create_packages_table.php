<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_type_id')
                ->constrained()
                ->cascadeOnUpdate();

            $table->foreignId('pickup_country_id')
                ->constrained('countries')
                ->cascadeOnUpdate();

            $table->foreignId('delivery_country_id')
                ->constrained('countries')
                ->cascadeOnUpdate();

            $table->integer('price')->default(0);
            $table->text('notes')->nullable();

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
        Schema::dropIfExists('packages');
    }
}

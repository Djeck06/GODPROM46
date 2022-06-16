<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('countries') ) {

            Schema::create('countries', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('code')->nullable();

                $table->boolean('is_pickup_country')->default(false);
                $table->boolean('is_delivery_country')->default(false);

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
        Schema::dropIfExists('countries');
    }
}

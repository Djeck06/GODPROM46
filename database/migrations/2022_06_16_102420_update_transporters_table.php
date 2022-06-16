<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTransportersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::table('transporters', function (Blueprint $table) {
                $table->string('lastname');
                $table->string('firstname');
                $table->string('tva_number')->nullable();
                $table->string('siren_number')->nullable();
                $table->string('siret_number')->nullable();
                $table->string('registration_number')->nullable();
                $table->string('naf_code')->nullable();
               
                $table->integer('status')->default('0');

          

            });

            Schema::table('transporters', function (Blueprint $table) {
             
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');

            });


            Schema::table('transporters', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()
                    ->constrained()
                    ->cascadeOnUpdate();
            });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

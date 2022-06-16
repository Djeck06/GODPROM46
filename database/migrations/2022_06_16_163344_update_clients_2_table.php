<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClients2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
           
            $table->string('first_name');
            $table->string('last_name');

        });

        Schema::table('users', function (Blueprint $table) {
           
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
        });

        Schema::table('clients', function (Blueprint $table) {
             
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

        });


        Schema::table('clients', function (Blueprint $table) {
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

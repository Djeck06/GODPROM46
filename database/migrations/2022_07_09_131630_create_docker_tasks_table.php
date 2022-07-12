<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDockerTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docker_tasks', function (Blueprint $table) {
            $table->id();
           

            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnUpdate();

            
            //$table->string('status')->defaut('pending'); // pending |packagesending | packageunsend| pickuppending | pickedup  |
            
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
        Schema::dropIfExists('docker_tasks');
    }
}

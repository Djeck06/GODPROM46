<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status', function (Blueprint $table) {
            $table->id();
           

            $table->string('source') ; // orders | docker_tasks | order_payments  | transporter_tasks
            $table->unsignedBigInteger('source_id') ; //
            $table->string('label')->nullable() ; 
            
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
        Schema::dropIfExists('status');
    }
}

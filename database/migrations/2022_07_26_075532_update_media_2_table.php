<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMedia2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
           
            //$table->string('document_type')->nullable();
            $table->string('extension')->nullable();
            

        });

        Schema::table('media', function (Blueprint $table) {
           
            // $table->dropColumn('manipulations');
            // $table->dropColumn('custom_properties');
            // $table->dropColumn('generated_conversions');
            // $table->dropColumn('responsive_images');
            // $table->dropColumn('uuid');
            
            // $table->softDeletes();
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

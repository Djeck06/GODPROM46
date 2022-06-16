<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettings1Table extends Migration
{
    public function up()
    {
        if ( ! Schema::hasTable('order_items') ) {

            Schema::create('order_items', function (Blueprint $table): void {
                $table->id();

                $table->string('group')->index();
                $table->string('name');
                $table->boolean('locked');
                $table->json('payload');

                $table->timestamps();
            });
        }
    }
}

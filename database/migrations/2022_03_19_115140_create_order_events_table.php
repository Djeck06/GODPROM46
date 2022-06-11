<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_events', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnUpdate();

            $table->string('event');
            $table->string('event_type'); // pickup | delivery | payment | order | order_status
            $table->string('event_code')->nullable();
            $table->string('event_message')->nullable();
            $table->string('event_status')->nullable();
            $table->timestamp('event_date');

            $table->string('event_initiator')->nullable();
            $table->string('event_initiator_id')->nullable();
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
        Schema::dropIfExists('order_events');
    }
}

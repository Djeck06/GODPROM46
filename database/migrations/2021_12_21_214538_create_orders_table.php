<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('orders') ) {

            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->foreignId('client_id')
                    ->constrained()
                    ->cascadeOnUpdate();

                $table->string('reference')->unique();

                // $table->boolean('pickup_at_office')->default(false);
                $table->string('pickup_country')->nullable();
                $table->string('pickup_city')->nullable();
                $table->string('pickup_address')->nullable();

                $table->string('delivery_country')->nullable();
                $table->string('delivery_city')->nullable();
                $table->string('delivery_address')->nullable();
                $table->string('delivery_phone')->nullable();

                $table->text('notes')->nullable();
                $table->string('status')->default('pending'); //pending | paying | paid | processing | completed | cancelled | refunded | closed | failed | expired |

                $table->integer('price')->default(0);
                $table->integer('insurance')->default(0);
                $table->integer('total')->default(0);

                $table->timestamps();
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
        Schema::dropIfExists('orders');
    }
}

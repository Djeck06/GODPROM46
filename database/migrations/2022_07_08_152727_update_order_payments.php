<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrderPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_payments', function (Blueprint $table) {
           
            // $table->string('status')->default('pending'); // pending /processing/succeeded / canceled
         
            // $table->softDeletes();
            // $table->timestamps();
            // $table->unsignedBigInteger('payment_platform_id')->nullable()->change();
            // $table->string('account_number')->nullable()->change();
            // $table->string('stripe_intent_id')->change();




        });

        $records= \App\Models\Order::where('delivery_country',Null)->get();
        foreach($records as $order){
            $order->delete();
        }
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

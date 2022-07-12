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
        
        if (!Schema::hasColumn('order_payments','deleted_at')) {
            Schema::table('order_payments', function (Blueprint $table) {

                $table->softDeletes();
            });
        }

        if (!Schema::hasColumn('order_payments','created_at')) {
            Schema::table('order_payments', function (Blueprint $table) {

                $table->timestamps();
            });
        }

        if (!Schema::hasColumn('order_payments','payment_platform_id')) {
            Schema::table('order_payments', function (Blueprint $table) {

                $table->unsignedBigInteger('payment_platform_id')->nullable()->change();
            });
        }

        if (!Schema::hasColumn('order_payments','stripe_intent_id')) {
            Schema::table('order_payments', function (Blueprint $table) {

                $table->string('stripe_intent_id')->nullable();
            });
        }

        


        if (!Schema::hasColumn('order_payments','account_number')) {
            Schema::table('order_payments', function (Blueprint $table) {

                $table->string('account_number')->nullable();

            });
        }else{
            Schema::table('order_payments', function (Blueprint $table) {

                $table->string('account_number')->nullable()->change();

            });
            
        }

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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->comment('Table containing the orders in the store');
            $table->id()->comment('Unique order identifier');
            $table->string('reference',15)->unique()->comment('Unique internal order reference');
            $table->unsignedBigInteger('request_id')->nullable()->comment('requestID from Placetopay');
            $table->string('process_url')->unique()->nullable()->comment('Unique proccess url placeToPay order');
            $table->foreignId('order_state_id')->default(1)->comment('Id containing the current state of the order')
                ->constrained()->onUpdate('cascade');
            $table->foreignId('customer_id')->comment('Id containing the client who placed the order')
                ->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedDecimal('total')->comment('Order total amount');
            $table->timestamps();
        });
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
};

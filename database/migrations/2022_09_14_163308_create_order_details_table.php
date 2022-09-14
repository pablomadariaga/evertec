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
        Schema::create('order_details', function (Blueprint $table) {
            $table->comment('Table containing the order detail');
            $table->id()->comment('Unique order detail identifier');
            $table->foreignId('order_id')->comment('Id that contains the order to which the detail belongs')
                ->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id')->comment('Id that contains the product that belongs to the detail')
                ->constrained()->onUpdate('cascade');
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
        Schema::dropIfExists('order_details');
    }
};

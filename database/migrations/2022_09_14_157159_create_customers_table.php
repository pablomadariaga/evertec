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
        Schema::create('customers', function (Blueprint $table) {
            $table->comment('Table containing the customers of the store');
            $table->id()->comment('Unique customer identifier');
            $table->string('address')->comment("customer's address");
            $table->string('first_name', 40)->comment("customer's first name");
            $table->string('last_name', 40)->comment("customer's last name");
            $table->string('email')->unique()->comment("customer's email");
            $table->string('mobile',25)->unique()->comment("customer's mobile");
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
        Schema::dropIfExists('customers');
    }
};

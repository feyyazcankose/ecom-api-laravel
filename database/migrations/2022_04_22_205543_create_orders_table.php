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
            $table->id();
            $table->unsignedBigInteger("basket_id");
            $table->unsignedBigInteger("adres_id");
            $table->integer("status");
            $table->timestamps();
            //foreign Key
            $table->foreign("basket_id")->references("id")->on("baskets");
            $table->foreign("adres_id")->references("id")->on("adres");
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

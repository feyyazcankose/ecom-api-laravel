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
        Schema::create('category_field_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("category_field_id");
            $table->unsignedBigInteger("product_id");
            $table->string('value');
            $table->timestamps();

             //Forign Key
             $table->foreign('category_field_id')->references('id')->on('category_fields');
             $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catagory_field_values');
    }
};

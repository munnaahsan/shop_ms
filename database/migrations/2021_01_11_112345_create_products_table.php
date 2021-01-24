<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('p_name');
            $table->foreignId('category_id');
            $table->string('p_sku');
            $table->number('uom_id');  //Foreign
            $table->number('p_quantity');
            $table->number('p_price');
            $table->string('p_image');
            $table->string('p_color')->nullable();
            $table->string('p_size');           
            $table->string('p_brand');
            $table->string('p_barcode')->unique();
            $table->boolean('p_status');            
            $table->string('p_keyword');
            $table->string('p_remarks');
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
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
        Schema::dropIfExists('products');
    }
}

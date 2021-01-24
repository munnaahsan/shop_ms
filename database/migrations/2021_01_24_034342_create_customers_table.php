<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('c_name');
            $table->string('c_email');
            $table->string('c_slug')->nullable();
            $table->string('c_address')->nullable();
            $table->string('c_phone')->nullable();
            $table->string('c_type')->nullable();
            $table->string('c_gift_card')->nullable();            
            $table->string('c_remarks')->nullable();            
            $table->string('cst_sales_invoice')->unique();    // relation hobe        
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
}

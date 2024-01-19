<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['all_menu', 'category', 'item']);
            $table->decimal('value');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->timestamps();

         //   $table->foreign('category_id')->references('id')->on('categories');
           // $table->foreign('item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}

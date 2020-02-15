<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogItemPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_item_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('item_id');
            $table->bigInteger('language_id');
            $table->integer('votes')->default(0);
            $table->timestamps();

/*             $table->foreign('item_id')
                    ->references('id')
                    ->on('catalog_items')
                    ->onDelete('cascade');

            $table->foreign('language_id')
                    ->references('id')
                    ->on('catalog_item_price_languages')
                    ->onDelete('cascade'); */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_item_prices');
    }
}

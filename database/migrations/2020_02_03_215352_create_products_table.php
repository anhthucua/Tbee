<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->bigInteger('supplier_id')->unsigned();
            $table->mediumInteger('category_level2_id')->unsigned();
            $table->bigInteger('image_id')->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
            $table->bigInteger('price')->unsigned();
            $table->bigInteger('sale_price')->unsigned();
            $table->mediumInteger('stock');
            $table->mediumInteger('purchased_number')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('is_banned')->default(false);
            $table->foreign('image_id')->references('id')->on('images');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('category_level2_id')->references('id')->on('category_level2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_supplier_id_foreign');
            $table->dropForeign('products_category_level2_id_foreign');
        });
        Schema::dropIfExists('products');
    }
}

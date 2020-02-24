<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryLevel2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_level2', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->mediumInteger('category_level1_id')->unsigned();
            $table->string('name');
            $table->timestamps();
            $table->foreign('category_level1_id')->references('id')->on('category_level1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_level2', function (Blueprint $table) {
            $table->dropForeign('category_level2_category_level1_id_foreign');
        });
        Schema::dropIfExists('category_level2');
    }
}

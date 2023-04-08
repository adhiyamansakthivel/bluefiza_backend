<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bl_sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('blcs_key')->unique();
            $table->string('blcs_name')->unique();
            $table->string('blcs_slug')->unique();
            $table->bigInteger('blcscat_id')->unsigned();
            $table->string('blcs_bgcolor')->unique()->nullable();
            $table->string('blcs_fontcolor')->unique()->nullable();
            $table->string('blcs_metatitle')->nullable();
            $table->string('blcs_metadesc')->nullable();
            $table->string('blcs_keywords')->nullable();
            $table->boolean('blcs_active')->default('1');
            $table->timestamps();

            $table->foreign('blcscat_id')->references('id')->on('bl_categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bl_sub_categories');
    }
}

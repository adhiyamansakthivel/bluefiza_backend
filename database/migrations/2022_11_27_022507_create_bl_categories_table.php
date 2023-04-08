<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bl_categories', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('blc_key')->unique();
            $table->string('blc_name');
            $table->string('blc_slug')->unique();
            $table->bigInteger('blcnav_id')->unsigned();
            $table->string('blc_color')->unique()->nullable();
            $table->text('blc_extra')->nullable();
            $table->string('blc_metatitle')->nullable();
            $table->string('blc_metadesc')->nullable();
            $table->string('blc_keywords')->nullable();
            $table->boolean('blc_active')->default('1');
            $table->timestamps();

            $table->foreign('blcnav_id')->references('id')->on('bl_navigations');
   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bl_categories');
    }
}

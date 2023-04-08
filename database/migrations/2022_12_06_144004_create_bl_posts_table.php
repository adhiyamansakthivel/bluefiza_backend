<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bl_posts', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('blp_key')->unique();
            $table->text('blp_image')->nullable();
            $table->string('blp_title')->unique();
            $table->string('blp_slug')->unique();
            $table->string('blp_calc')->nullable();
            $table->text('blp_desc')->nullable();
            $table->string('blp_metatitle')->nullable();
            $table->text('blp_metadesc')->nullable();
            $table->text('blp_keywords')->nullable();
            $table->text('blp_extra')->nullable();
            $table->bigInteger('blpcat_id')->unsigned()->nullable();
            $table->bigInteger('blpusr_id')->unsigned()->nullable();
            $table->boolean('blp_active')->default('1');
            $table->timestamps();

            $table->foreign('blpcat_id')->references('id')->on('bl_categories');
            $table->foreign('blpusr_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bl_posts');
    }
}

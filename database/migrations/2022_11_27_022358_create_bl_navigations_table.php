<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlNavigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bl_navigations', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('bln_key')->unique();
            $table->string('bln_name')->unique();
            $table->string('bln_color')->unique()->nullable();
            $table->string('bln_slug')->unique()->nullable();
            $table->text('bln_extra')->nullable();
            $table->boolean('bln_active')->default('1');
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
        Schema::dropIfExists('bl_navigations');
    }
}

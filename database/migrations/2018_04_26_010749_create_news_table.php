<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 255)->unique()->nullable();
            $table->string('title')->default('No Title');
            $table->string('thumbnail', 512)->nullable()->default(null);
            $table->string('imagepath', 512)->nullable()->default(null);
            $table->text('content')->nullable()->default(null);
            $table->boolean('is_hidden')->default(false);
            $table->integer('view')->default(0);
            $table->integer('like')->default(0);
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
        Schema::dropIfExists('news');
    }
}

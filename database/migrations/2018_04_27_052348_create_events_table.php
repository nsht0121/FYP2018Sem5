<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 255)->nullable()->unique();
            $table->string('title', 255);
            $table->string('thumbnail', 512)->nullable()->default(null);
            $table->string('imagepath', 512)->nullable()->default(null);
            $table->text('description')->nullable();
            $table->string('venue', 255)->nullable();
            $table->decimal('fee', 6, 2)->nullable()->default(0);
            $table->dateTime('apply_start')->nullable();
            $table->dateTime('apply_end')->nullable();
            $table->dateTime('event_start')->nullable();
            $table->dateTime('event_end')->nullable();
            $table->boolean('is_hidden')->default(0);
            $table->boolean('is_canceled')->default(0);
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
        Schema::dropIfExists('events');
    }
}

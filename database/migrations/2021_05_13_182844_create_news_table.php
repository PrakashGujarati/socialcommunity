<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->text('headline');
            $table->string('title');
            $table->string('category')->nullable();
            $table->text('detail_report')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('news_image')->nullable();
            $table->dateTime('reported_datetime')->nullable();
            $table->string('reference')->nullable();
            $table->string('status')->nullable();
            $table->tinyInteger('done_by');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBirthdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('birthdays', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birthdate')->nullable();
            $table->time('time')->nullable();
            $table->string('place')->nullable();
            $table->text('wishes')->nullable();
            $table->string('picture')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('birthdays');
    }
}

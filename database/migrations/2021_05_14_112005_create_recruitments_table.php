<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitments', function (Blueprint $table) {
            $table->id();
            $table->text('headline');
            $table->string('title');
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->string('skills')->nullable();
            $table->string('education_quailification')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('reference_url')->nullable();
            $table->dateTime('reported_datetime')->nullable();
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
        Schema::dropIfExists('recruitments');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('birth_date')->nullable();
            $table->time('birth_time')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('education')->nullable();
            $table->string('occupation')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->tinyInteger('brothers')->nullable();
            $table->tinyInteger('sisters')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->bigInteger('father_contact')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->text('resident_address')->nullable();
            $table->text('native_address')->nullable();
            $table->string('maternal')->nullable();
            $table->string('maternal_place')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('expectations')->nullable();
            $table->string('remark')->nullable();
            $table->string('picture')->nullable();
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
        Schema::dropIfExists('candidates');
    }
}

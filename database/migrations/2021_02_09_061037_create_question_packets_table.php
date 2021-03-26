<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionPacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_packets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_type_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('banner_path')->nullable();
            $table->integer('amount');
            $table->integer('time');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('question_packets');
    }
}

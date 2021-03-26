<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserQuestionPacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_question_packets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('question_packet_id');
            $table->boolean('completed')->default(0);
            $table->float('score', 8, 2)->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->unsignedSmallInteger('trueAnswer')->nullable();
            $table->unsignedSmallInteger('falseAnswer')->nullable();
            $table->unsignedSmallInteger('nullAnswer')->nullable();
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
        Schema::dropIfExists('user_question_packets');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_id')->unsigned()->notNull();
            $table->integer('question_id')->unsigned()->notNull();
            $table->integer('answer_id')->unsigned()->notNull();
            $table->tinyInteger('correct')->default(0)->notNull();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('results', function (Blueprint $table) {
            $table->dropForeign('results_answer_id_foreign');
            $table->dropForeign('results_question_id_foreign');
            $table->dropForeign('results_test_id_foreign');
        });

        Schema::dropIfExists('results');
    }
}

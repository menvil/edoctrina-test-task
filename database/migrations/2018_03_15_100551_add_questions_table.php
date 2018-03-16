<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_id')->unsigned()->notNull();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign('questions_test_id_foreign');
        });
        Schema::dropIfExists('questions');
    }
}

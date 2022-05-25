<?php

use App\Models\PesquisasQuestoes;
use App\Models\PesquisasRespostas;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesquisasQuestoesRespostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('survey_question_answers')){
            Schema::create('survey_question_answers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('survey_question_id');
                $table->unsignedBigInteger('survey_answer_id');
                $table->text('answer');
                $table->timestamps();
            });
        }
        Schema::table('survey_question_answers', function (Blueprint $table) {
            $table->foreign('survey_question_id')->references('id')->on('survey_questions')->onDelete('cascade');
            $table->foreign('survey_answer_id')->references('id')->on('survey_answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_question_answers');
    }
}

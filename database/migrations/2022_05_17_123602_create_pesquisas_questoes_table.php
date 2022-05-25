<?php

use App\Models\Pesquisas;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesquisasQuestoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('survey_questions')){
            Schema::create('survey_questions', function (Blueprint $table) {
                $table->id();
                $table->string('type',45);
                $table->string('question',2000);
                $table->longText('description')->nullable();
                $table->longText('data')->nullable();
                $table->unsignedBigInteger('survey_id');
                $table->timestamps();
            });
        }
        Schema::table('survey_questions', function (Blueprint $table) {
            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_questions');
    }
}

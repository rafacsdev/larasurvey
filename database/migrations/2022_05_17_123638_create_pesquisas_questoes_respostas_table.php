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
        if(!Schema::hasTable('pesquisas_questoes_respostas')){
            Schema::create('pesquisas_questoes_respostas', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('pesquisas_questoes_id');
                $table->unsignedBigInteger('pesquisas_respostas_id');
                $table->text('resposta');
                $table->timestamps();
            });
        }
        Schema::table('pesquisas_questoes_respostas', function (Blueprint $table) {
            $table->foreign('pesquisas_questoes_id')->references('id')->on('pesquisas_questoes')->onDelete('cascade');
            $table->foreign('pesquisas_respostas_id')->references('id')->on('pesquisas_respostas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesquisas_questoes_respostas');
    }
}

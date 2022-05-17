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
        if(!Schema::hasTable('pesquisas_questoes')){
            Schema::create('pesquisas_questoes', function (Blueprint $table) {
                $table->id();
                $table->string('tipo',45);
                $table->string('questao',2000);
                $table->longText('descricao')->nullable();
                $table->longText('data')->nullable();
                $table->unsignedBigInteger('pesquisa_id');
                $table->timestamps();
            });
        }
        Schema::table('pesquisas_questoes', function (Blueprint $table) {
            $table->foreign('pesquisa_id')->references('id')->on('pesquisas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesquisas_questoes');
    }
}

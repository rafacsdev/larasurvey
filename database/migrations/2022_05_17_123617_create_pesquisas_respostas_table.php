<?php

use App\Models\Pesquisas;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesquisasRespostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('pesquisas_respostas')){
            Schema::create('pesquisas_respostas', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('pesquisas_id');
                $table->timestamp('inicio')->nullable();
                $table->timestamp('fim')->nullable();
            });
        }
        Schema::table('pesquisas_respostas', function (Blueprint $table) {
            $table->foreign('pesquisas_id')->references('id')->on('pesquisas')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesquisas_respostas');
    }
}

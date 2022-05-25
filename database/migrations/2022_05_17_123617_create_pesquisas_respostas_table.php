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
        if(!Schema::hasTable('survey_answers')){
            Schema::create('survey_answers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('survey_id');
                $table->timestamp('start_date')->nullable();
                $table->timestamp('end_date')->nullable();
            });
        }
        Schema::table('survey_answers', function (Blueprint $table) {
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
        Schema::dropIfExists('survey_answers');
    }
}

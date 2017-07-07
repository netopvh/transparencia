<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfraestruturaAtuacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infraestrutura_atuacao', function (Blueprint $table) {
            $table->integer('infraestrutura_id')->nullable()->unsigned();
            $table->integer('codigo_entidade')->nullable();
            $table->integer('codigo_atuacao')->nullable();
            $table->string('nome_atuacao')->nullable();
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
        Schema::dropIfExists('infraestrutura_atuacao');
    }
}

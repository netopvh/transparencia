<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfraestruturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infraestruturas', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('unidade');
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('cep')->nullable();
            $table->string('telefone')->nullable();
            $table->integer('codigo_categoria')->nullable();
            $table->string('nome_categoria')->nullable();
            $table->integer('codigo_entidade')->nullable();
            $table->integer('codigo_atuacao')->nullable();
            $table->string('nome_atuacao')->nullable();
            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infraestruturas');
    }
}

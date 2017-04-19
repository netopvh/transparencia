<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstruturaRemuneratoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estrutura_remuneratoria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('casa_id')->unsigned();
            $table->foreign('casa_id')->references('id')->on('casas');
            $table->string('cargo');
            $table->decimal('ponto_ini',10,2);
            $table->decimal('ponto_fin',10,2);
            $table->integer('empregados')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('estrutura_remuneratoria');
    }
}

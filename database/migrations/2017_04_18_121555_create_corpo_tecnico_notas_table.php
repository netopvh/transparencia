<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorpoTecnicoNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corpo_tecnico_notas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('casa_id')->unsigned();
            $table->foreign('casa_id')->references('id')->on('casas');
            $table->longText('notas');
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
        Schema::dropIfExists('corpo_tecnico_notas');
    }
}

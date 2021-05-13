<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecoFisicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endereco_fisicos', function (Blueprint $table) {
            $table->id();
            $table->string('endereco');
            $table->string('cidade');
            $table->string('estado');
            $table->unsignedBigInteger('id_endereco_telefone');
            $table->foreign('id_endereco_telefone')->references('id')->on('endereco_telefones');
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
        Schema::dropIfExists('endereco_fisicos');
    }
}

<?php

#Import
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecoTelefonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endereco_telefones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_info_usuarios');
            $table->foreign('id_info_usuarios')->references('id')->on('info_usuarios');
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
        Schema::dropIfExists('endereco_telefones');
    }
}

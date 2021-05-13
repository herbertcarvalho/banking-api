<?php

#Import
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecoVirtualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endereco_virtuals', function (Blueprint $table) {
            $table->id();
            $table->string('endereco_virtual');
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
        Schema::dropIfExists('endereco_virtuals');
    }
}

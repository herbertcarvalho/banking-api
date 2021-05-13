<?php

#Import
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasAbertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_abertas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_info_usuario');
            $table->foreign('id_info_usuario')->references('id')->on('info_usuarios');
            $table->unsignedBigInteger('conta')->unique();
            $table->unsignedBigInteger('agencia')->unique();
            $table->decimal('saldo_atual' ,11,2);
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
        Schema::dropIfExists('contas_abertas');
    }
}

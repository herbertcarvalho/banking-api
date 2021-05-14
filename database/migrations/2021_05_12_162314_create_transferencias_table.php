<?php

#Import
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('receptor_id');
            $table->foreign('receptor_id')->references('id')->on('users');
            $table->unsignedBigInteger('doador_id');
            $table->foreign('doador_id')->references('id')->on('users');
            $table->unsignedBigInteger('conta_doadora');
            $table->unsignedBigInteger('conta_receptora');
            $table->decimal('quantia_transferida',11,2);
            $table->date('data_transferencia');
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
        Schema::dropIfExists('transferencias');
    }
}

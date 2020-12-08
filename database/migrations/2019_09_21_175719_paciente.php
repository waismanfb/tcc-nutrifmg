<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Paciente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string       ('nome', 100);
            $table->integer      ('sexo');
            $table->date         ('dataNascimento');
            $table->double       ('anosEstudo', 8, 1);
            $table->double       ('renda', 8, 2);
            $table->integer      ('curso');
            $table->integer      ('numPessoasCasa');
            $table->integer      ('moradia');
            $table->integer      ('numRefeicoes');
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
        Schema::dropIfExists('pacientes');
    }
}

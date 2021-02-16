<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDietasPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dietas_pacientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_paciente');
            $table->integer('id_alimento')->nullable();
            $table->integer('id_receita')->nullable();
            $table->integer('id_dieta')->nullable();
            $table->decimal('quantidade',12, 2);
            $table->date('data_coleta');
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
        Schema::dropIfExists('dietas_pacientes');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvAntropometricasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('av_antropometricas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_paciente');
            $table->date('data');
            $table->decimal('peso',8,2);
            $table->decimal('altura',8,2);
            $table->decimal('pct',8,2)->nullable();
            $table->decimal('idade',8,2)->nullable();
            $table->decimal('imc',8,2)->nullable();
            $table->integer('meses')->nullable();
            $table->string('classificacaoImcIdade')->nullable();
            $table->string('scoreImcIdade')->nullable();
            $table->string('classificacaoEstIdade')->nullable();
            $table->string('scoreEstIdade')->nullable();

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
        Schema::dropIfExists('av_antropometricas');
    }
}

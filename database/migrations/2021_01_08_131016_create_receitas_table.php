<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receitas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string       ('nome', 100)->nullable();

            $table->double       ('quantidadeTotal', 8, 4)->nullable();
            $table->double       ('quantidadePorcao', 8, 4)->nullable();
            $table->integer      ('totalEnergiaKcal')->nullable();
            $table->double       ('totalProteina', 8, 4)->nullable();
            $table->double       ('totalLipideos', 8, 4)->nullable();
            $table->double       ('totalCarboidrato', 8, 4)->nullable();
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
        Schema::dropIfExists('receitas');
    }
}

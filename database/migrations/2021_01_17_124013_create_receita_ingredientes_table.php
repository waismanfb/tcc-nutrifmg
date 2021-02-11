<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceitaIngredientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receita_ingredientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string       ('medida', 100)->nullable();
            $table->integer      ('quantidade')->nullable();

            $table->integer      ('id_alimento')->nullable();
            $table->integer      ('id_receitas')->nullable();
            $table->double       ('umidade', 8, 2)->nullable();
            $table->double       ('energiaKcal', 8, 2)->nullable();
            $table->double       ('energiaKj', 8, 2)->nullable();
            $table->double       ('proteina', 8, 2)->nullable();
            $table->double       ('lipideos', 8, 2)->nullable();
            $table->double       ('colesterol', 8, 2)->nullable();
            $table->double       ('carboidrato', 8, 2)->nullable();
            $table->double       ('fibraAlimentar', 8, 2)->nullable();
            $table->double       ('cinzas', 8, 2)->nullable();
            $table->double       ('calcio', 8, 2)->nullable();
            $table->double       ('magnesio', 8, 2)->nullable();
            $table->double       ('manganes', 8, 2)->nullable();
            $table->double       ('fosforo', 8, 2)->nullable();
            $table->double       ('ferro', 8, 2)->nullable();
            $table->double       ('sodio', 8, 2)->nullable();
            $table->double       ('potassio', 8, 2)->nullable();
            $table->double       ('cobre', 8, 2)->nullable();
            $table->double       ('zinco', 8, 2)->nullable();
            $table->double       ('retinol', 8, 2)->nullable();
            $table->double       ('re', 8, 2)->nullable();
            $table->double       ('rae', 8, 2)->nullable();
            $table->double       ('tiamina', 8, 2)->nullable();
            $table->double       ('riboflavina', 8, 2)->nullable();
            $table->double       ('piridoxina', 8, 2)->nullable();
            $table->double       ('niacina', 8, 2)->nullable();
            $table->double       ('vitaminaC', 8, 2)->nullable();
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
        Schema::dropIfExists('receita_ingredientes');
    }
}

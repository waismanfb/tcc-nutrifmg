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
            $table->double       ('umidade', 12, 2)->nullable();
            $table->double       ('energiaKcal', 12, 2)->nullable();
            $table->double       ('energiaKj', 12, 2)->nullable();
            $table->double       ('proteina', 12, 2)->nullable();
            $table->double       ('lipideos', 12, 2)->nullable();
            $table->double       ('colesterol', 12, 2)->nullable();
            $table->double       ('carboidrato', 12, 2)->nullable();
            $table->double       ('fibraAlimentar', 12, 2)->nullable();
            $table->double       ('cinzas', 12, 2)->nullable();
            $table->double       ('calcio', 12, 2)->nullable();
            $table->double       ('magnesio', 12, 2)->nullable();
            $table->double       ('manganes', 12, 2)->nullable();
            $table->double       ('fosforo', 12, 2)->nullable();
            $table->double       ('ferro', 12, 2)->nullable();
            $table->double       ('sodio', 12, 2)->nullable();
            $table->double       ('potassio', 12, 2)->nullable();
            $table->double       ('cobre', 12, 2)->nullable();
            $table->double       ('zinco', 12, 2)->nullable();
            $table->double       ('retinol', 12, 2)->nullable();
            $table->double       ('re', 12, 2)->nullable();
            $table->double       ('rae', 12, 2)->nullable();
            $table->double       ('tiamina', 12, 2)->nullable();
            $table->double       ('riboflavina', 12, 2)->nullable();
            $table->double       ('piridoxina', 12, 2)->nullable();
            $table->double       ('niacina', 12, 2)->nullable();
            $table->double       ('vitaminaC', 12, 2)->nullable();
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

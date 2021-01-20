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
            $table->string       ('nome', 100)->nullable();;            
            $table->string       ('medida', 100)->nullable();;
            $table->integer      ('quantidade')->nullable();;

            $table->integer      ('id_alimento')->nullable();;
            $table->integer      ('id_receitas')->nullable();;
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

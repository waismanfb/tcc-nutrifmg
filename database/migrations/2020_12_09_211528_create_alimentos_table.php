<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alimentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string       ('nome', 100)->nullable();
            $table->string       ('tipo', 100)->nullable();
            $table->string       ('grupo', 100)->nullable();
            $table->string       ('fonte', 100)->nullable();
            $table->double       ('umidade', 8, 1)->nullable();
            $table->integer      ('energiaKcal')->nullable();
            $table->integer      ('energiaKj')->nullable();
            $table->double       ('proteina', 8, 1)->nullable();
            $table->double       ('lipideos', 8, 1)->nullable();
            $table->string       ('colesterol', 10)->nullable();
            $table->double       ('carboidrato', 8, 1)->nullable();
            $table->double       ('fibraAlimentar', 8, 1)->nullable();
            $table->double       ('cinzas', 8, 1)->nullable();
            $table->integer      ('calcio')->nullable();
            $table->integer      ('magnesio')->nullable();
            $table->double       ('manganes', 8, 2)->nullable();
            $table->integer      ('fosforo')->nullable();
            $table->double       ('ferro', 8, 1)->nullable();
            $table->integer      ('sodio')->nullable();
            $table->integer      ('potassio')->nullable();
            $table->double       ('cobre', 8, 2)->nullable();
            $table->double       ('zinco', 8, 1)->nullable();
            $table->string       ('retinol', 100)->nullable();
            $table->string       ('re', 100)->nullable();
            $table->string       ('rae', 100)->nullable();
            $table->double       ('tiamina', 8, 2)->nullable();
            $table->double       ('riboflavina', 8, 2)->nullable();
            $table->double       ('piridoxina', 8, 2)->nullable();
            $table->double       ('niacina', 8, 2)->nullable();
            $table->double       ('vitaminaC', 8, 2)->nullable();          
            $table->timestamps   ();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alimentos');
    }
}

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
            $table->string       ('grupo', 100)->nullable();
            $table->string       ('fonte', 100)->nullable();
            $table->integer      ('energiaKcal')->nullable();
            $table->double       ('proteina', 8, 1)->nullable();
            $table->double       ('lipideos', 8, 1)->nullable();
            $table->double       ('carboidrato', 8, 1)->nullable();
         
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

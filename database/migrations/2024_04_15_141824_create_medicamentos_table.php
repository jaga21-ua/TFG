<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentosTable extends Migration
{
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nregistro')->unique();
            $table->string('nombre');
            $table->string('photo');
            $table->string('pactivos');
            $table->string('labtitular');
            $table->string('estado');
            $table->text('cpresc')->nullable();
            $table->boolean('comerc');
            $table->boolean('receta');
            $table->boolean('conduc');
            $table->boolean('triangulo');
            $table->boolean('huerfano');
            $table->boolean('biosimilar');
            $table->string('viasAdministracion')->nullable();
            $table->string('dosis')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicamentos');
    }
}


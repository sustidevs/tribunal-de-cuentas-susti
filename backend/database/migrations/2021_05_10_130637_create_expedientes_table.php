<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nro_expediente')->unique();
            $table->unsignedInteger('fojas');
            $table->date('fecha')->nullable();
            $table->unsignedInteger('area_actual_id');
            $table->string('area_actual_type');
            $table->double('monto',10,2)->nullable();
            $table->string('archivos')->nullable();
            $table->foreignId('prioridad')->constrained('prioridad_expedientes');
            $table->foreignId('tipo_expediente')->constrained('tipo_expedientes');
            $table->foreignId('estado_expediente')->constrained('estado_expedientes');
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
        Schema::dropIfExists('expedientes');
    }
}

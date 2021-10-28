<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historiales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('cuerpo_id')->constrained('cuerpos');
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedBigInteger('area_origen_id');//->constrained('sub_areas');
            $table->unsignedBigInteger('area_destino_id');//->constrained('sub_areas');
            $table->string('area_origen_type');
            $table->string('area_destino_type');
            $table->integer('fojas');
            $table->date('fecha');
            $table->time('hora');
            $table->string('motivo')->nullable();
            $table->string('archivo')->nullable();
            $table->integer('estado');
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
        Schema::dropIfExists('historiales');
    }
}

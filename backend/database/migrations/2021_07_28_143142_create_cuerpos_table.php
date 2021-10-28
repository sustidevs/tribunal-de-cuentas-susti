<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuerposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuerpos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('cantidad_fojas');
            $table->foreignId('caratula_id')->constrained('caratulas');
            $table->integer('estado');
            $table->unsignedBigInteger('area_id');
            $table->string('area_type');
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
        Schema::dropIfExists('cuerpos');
    }
}

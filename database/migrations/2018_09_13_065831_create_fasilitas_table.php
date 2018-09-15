<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFasilitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kategorifasilitas_id');
            $table->string('nama')->nullable();
            $table->string('slug')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('kategorifasilitas_id')->references('id')->on('kategorifasilitas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fasilitas');
    }
}

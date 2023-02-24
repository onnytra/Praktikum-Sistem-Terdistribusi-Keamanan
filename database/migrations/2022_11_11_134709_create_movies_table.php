<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('judul');
            $table->date('tanggal');
            $table->string('genre');
            $table->text('sinopsis');
            $table->string('poster')->nullable();
            $table->unsignedInteger('id_live');
            $table->foreign('id_live')->references('id_live')->on('lives')->onDelete('cascade');
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
        Schema::dropIfExists('movies');
    }
}

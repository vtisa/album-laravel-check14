<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('foto', function (Blueprint $table) {
            $table->id('foto_id');
            $table->string('foto_nombre');
            $table->string('foto_descripcion');
            $table->string('foto_ruta');
            $table->foreign('album_id')->references('album_id')->on('album');
            $table->unsignedBigInteger('album_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foto');
    }
};

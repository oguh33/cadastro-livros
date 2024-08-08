<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('livro_valor', function (Blueprint $table) {
            $table->increments('codVal');
            $table->integer('livro_codl')->unsigned();
            $table->float('valor');
            $table->timestamps();

            $table->foreign('livro_codl')->references('codl')->on('livro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livro_valor');
    }
};

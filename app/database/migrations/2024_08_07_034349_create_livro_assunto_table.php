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
        Schema::create('livro_assunto', function (Blueprint $table) {
            $table->integer('livro_codl')->unsigned();
            $table->integer('assunto_codAs')->unsigned();
            $table->timestamps();

            $table->primary(['livro_codl', 'assunto_codAs'])->unique();

            $table->foreign('livro_codl')->references('codl')->on('livro');
            $table->foreign('assunto_codAs')->references('codAs')->on('assunto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livro_assunto');
    }
};

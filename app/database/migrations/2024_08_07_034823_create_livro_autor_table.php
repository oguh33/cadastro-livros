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
        Schema::create('livro_autor', function (Blueprint $table) {
            $table->integer('livro_codl')->unsigned();
            $table->integer('autor_codAu')->unsigned();
            $table->timestamps();

            $table->primary(['livro_codl', 'autor_codAu'])->unique();

            $table->foreign('livro_codl')->references('codl')->on('livro');
            $table->foreign('autor_codAu')->references('codAu')->on('autor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livro_autor');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE VIEW vw_livros as
                        SELECT
                            a.nome AS autor,
                            a.codAu,
                            l.titulo,
                            l.editora,
                            l.edicao,
                            l.anoPublicacao,
                            l.valor,
                            s.codAs,
                            s.descricao as assunto
                        FROM autor a
                        JOIN livro_autor la ON a.codAu = la.autor_codAu
                        JOIN livro l ON la.livro_codl = l.codl
                        JOIN livro_assunto las ON l.codl = las.livro_codl
                        JOIN assunto s ON las.assunto_codAs = s.codAs
                        ORDER BY a.nome, l.titulo;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW vw_livros");
    }
};

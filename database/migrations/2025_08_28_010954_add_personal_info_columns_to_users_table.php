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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cpf')
                ->unique()
                ->after('email');

            /**
             * Não confundir com 'role'.
             *
             * 'cargo' é uma coluna para propósito cadastral, e difere de 'role',
             * coluna criada com objetivo exclusivo de gerenciar os níveis de acesso
             * do sistema.
             */
            $table->string('cargo')
                ->after('cpf');

            $table->date('data_nascimento')
                ->after('cargo');

            $table->string('cep', 9)
                ->nullable()
                ->after('data_nascimento');

            $table->string('endereco')
                ->nullable()
                ->after('cep');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['cpf', 'data_nascimento', 'cep', 'endereco']);
        });
    }
};

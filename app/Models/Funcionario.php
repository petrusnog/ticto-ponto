<?php

namespace App\Models;

/**
 * Classe Funcionario
 *
 * Essa classe representa os usuários que possuem nível de acesso (role) "funcionario".
 * É utilizada principalmente em controllers relacionados a gestão de funcionários,
 * fornecendo uma interface clara para trabalhar apenas com esse subconjunto de usuários.
 *
 * Benefícios técnicos:
 * - Evita a necessidade de repetir manualmente o filtro por role em cada consulta de funcionários.
 * - Simplifica o código nos controllers que lidam com funcionários.
 *
 * Exemplo de uso:
 * - $funcionarios = Funcionario::all(); // Retorna apenas usuários com role "funcionario"
 */
class Funcionario extends User
{
    /**
     * Constante QUANTIDADE_POR_PAGINA
     *
     * Determina a quantidade de funcionários por página na tela de listagem.
     */
    public const QUANTIDADE_POR_PAGINA = 10;

    /**
     * Método booted()
     *
     * O método booted aplica um Global Scope ao builder da model.
     * Esse escopo adiciona automaticamente um filtro às consultas, garantindo que todos os
     * registros retornados por esta model correspondam a usuários com role "funcionario".
     */
    protected static function booted()
    {
        static::addGlobalScope('users', function ($query) {
            $query->whereHas('role', function ($q) {
                $q->where('name', 'funcionario');
            });
        });
    }
}
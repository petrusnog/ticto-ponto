<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe Ponto
 *
 * Essa classe representa os pontos eletrônicos registrados pelos usuários.
 */
class Ponto extends Model
{
    protected $casts = [
        'registered_at' => 'datetime',
    ];

    /**
     * Constante QUANTIDADE_POR_PAGINA
     *
     * Determina a quantidade de pontos por página na tela de listagem.
     */
    public const QUANTIDADE_POR_PAGINA = 10;

    /**
     * Constante INTERVALO_ENTRE_PONTOS
     *
     * Intervalo em segundos entre o registro de cada ponto eletrônico.
     */
    public const INTERVALO_ENTRE_PONTOS = 60;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'registered_at'
    ];

    /**
     * Ponto pertence a um Usuário
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

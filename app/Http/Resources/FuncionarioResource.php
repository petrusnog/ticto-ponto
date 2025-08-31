<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FuncionarioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'cargo' => $this->cargo,
            'data_nascimento' => $this->data_nascimento,
            'cep' => $this->cep,
            'endereco' => $this->endereco
        ];
    }
}

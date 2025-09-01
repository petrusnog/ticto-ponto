<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PontoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->user->name,
            'cpf' => $this->user->cpf,
            'data' => $this->registered_at->format('d/m/Y'),
            'hora' => $this->registered_at->format('H:i:s')
        ];
    }
}
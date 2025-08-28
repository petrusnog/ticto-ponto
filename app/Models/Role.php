<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected function users()
    {
        /**
         * Uma Role (nível de acesso) possui diversos usuários.
         */
        return $this->hasMany(User::class);
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Funcionário pertence a um Administrador.
     */
    protected function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Administrador possui diversos Funcionários.
     */
    protected function funcionarios()
    {
        return $this->hasMany(User::class, 'admin_id');
    }

    /**
     * Usuário pertence a um Role (nível de acesso).
     */
    protected function role()
    {
        return $this->belongsTo(Role::class);
    }
}

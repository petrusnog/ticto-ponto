<?php

namespace App\Http\Requests;

use App\Rules\Cpf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateFuncionarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->role->name === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $funcionarioId = $this->route('id');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'max:100',
                'email',
                Rule::unique('users', 'email')->ignore($funcionarioId)
            ],
            'cpf' => [
                'required',
                'string',
                'min:14',
                'max:14',
                new Cpf(),
                Rule::unique('users', 'cpf')->ignore($funcionarioId)
            ],
            'password' => ['nullable', 'string'],
            'cargo' => ['required', 'string', 'max:100'],
            'data_nascimento' => ['required', 'date'],
            'cep' => ['nullable', 'string', 'min:8', 'max:8'],
            'endereco' => ['nullable', 'string', 'max:255'],
            'numero' => ['nullable', 'string', 'max:50'],
            'complemento' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute deve ser uma string.',
            'max' => 'O campo :attribute não pode ter mais que :max caracteres.',
            'min' => 'O campo :attribute deve ter pelo menos :min caracteres.',
            'unique' => 'O valor informado para :attribute já está em uso.',
            'email.email' => 'O campo email deve ser um endereço de e-mail válido.',
            'cpf.min' => 'O CPF deve ter exatamente 14 caracteres.',
            'cpf.max' => 'O CPF deve ter exatamente 14 caracteres.',
            'cep.min' => 'O CEP deve ter 8 caracteres.',
            'cep.max' => 'O CEP deve ter 8 caracteres.',
        ];
    }
}

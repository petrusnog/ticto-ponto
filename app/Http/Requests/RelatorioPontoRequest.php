<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Support\Carbon;

class RelatorioPontoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ajuste conforme sua regra de autorização
    }

    public function rules(): array
    {
        return [
            'data_inicial' => ['nullable', 'date', 'before_or_equal:now'],
            'data_final'   => ['nullable', 'date', 'before_or_equal:now'],
        ];
    }

    /**
     * Lógica de validação das datas do relatório.
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $dataInicial = $this->input('data_inicial');
            $dataFinal   = $this->input('data_final');

            // Se informou só uma das duas - erro
            if (($dataInicial && !$dataFinal) || (!$dataInicial && $dataFinal)) {
                $validator->errors()->add(
                    'periodo',
                    'Você deve informar tanto a data inicial quanto a final, ou deixar ambas em branco.'
                );
                return;
            }

            // Se ambas preenchidas, checa se inicial <= final
            if ($dataInicial && $dataFinal) {
                $inicio = Carbon::parse($dataInicial);
                $fim    = Carbon::parse($dataFinal);

                if ($inicio->gt($fim)) {
                    $validator->errors()->add(
                        'data_inicial',
                        'A data inicial não pode ser posterior à data final.'
                    );
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'data_inicial.required' => 'Informe a data inicial.',
            'data_inicial.date' => 'A data inicial deve ser uma data válida.',
            'data_inicial.before_or_equal' => 'A data inicial não pode ser futura.',
            'data_final.required' => 'Informe a data final.',
            'data_final.date' => 'A data final deve ser uma data válida.',
            'data_final.before_or_equal' => 'A data final não pode ser futura.',
        ];
    }
}

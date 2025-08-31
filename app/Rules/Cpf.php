<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Cpf implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $value);

        // Deve ter 11 dígitos
        if (strlen($cpf) != 11) {
            $fail("O campo {$attribute} deve conter 11 números.");
            return;
        }

        // Evita CPFs com todos os números iguais
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $fail("O campo {$attribute} informado é inválido.");
            return;
        }

        // Valida os dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $fail("O campo {$attribute} informado é inválido.");
                return;
            }
        }
    }
}

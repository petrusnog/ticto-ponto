<?php

namespace App\Helpers;

class CpfHelper
{
    public static function generate(bool $formatted = false): string
    {
        $n = [];
        for ($i = 0; $i < 9; $i++) {
            $n[$i] = random_int(0, 9);
        }

        // Calcula dígito 1
        $d1 = 0;
        for ($i = 0, $j = 10; $i < 9; $i++, $j--) {
            $d1 += $n[$i] * $j;
        }
        $d1 = 11 - ($d1 % 11);
        $n[9] = ($d1 >= 10) ? 0 : $d1;

        // Calcula dígito 2
        $d2 = 0;
        for ($i = 0, $j = 11; $i < 10; $i++, $j--) {
            $d2 += $n[$i] * $j;
        }
        $d2 = 11 - ($d2 % 11);
        $n[10] = ($d2 >= 10) ? 0 : $d2;

        $cpf = implode('', $n);

        if ($formatted) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $cpf);
        }

        return $cpf;
    }
}

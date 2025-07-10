<?php
declare(strict_types=1);

namespace Clases;

require_once __DIR__ . '/MatrizOperaciones.php';

abstract class MatrizAbstracta implements MatrizOperaciones {
    protected array $matriz;

    public function __construct(array $matriz) {
        $this->matriz = array_map(function($fila) {
            return array_map('floatval', $fila);
        }, $matriz);
    }

    abstract public function multiplicar(array $matriz): array;
    abstract public function inversa(): array;

    public function determinante(): float {
        $n = count($this->matriz);
        if ($n !== count($this->matriz[0])) {
            throw new \Exception("La matriz debe ser cuadrada para calcular el determinante.");
        }

        return $this->cofactorDeterminante($this->matriz);
    }

    private function cofactorDeterminante(array $matriz): float {
        $n = count($matriz);

        if ($n === 1) return $matriz[0][0];
        if ($n === 2) {
            return $matriz[0][0]*$matriz[1][1] - $matriz[0][1]*$matriz[1][0];
        }

        $det = 0;
        for ($j = 0; $j < $n; $j++) {
            $submatriz = [];
            for ($i = 1; $i < $n; $i++) {
                $fila = array_merge(array_slice($matriz[$i], 0, $j), array_slice($matriz[$i], $j+1));
                $submatriz[] = $fila;
            }
            $det += ($j % 2 === 0 ? 1 : -1) * $matriz[0][$j] * $this->cofactorDeterminante($submatriz);
        }
        return $det;
    }
}

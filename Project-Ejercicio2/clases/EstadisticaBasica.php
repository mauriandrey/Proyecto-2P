<?php
declare(strict_types=1);
namespace Clases;

require_once __DIR__ . '/Estadistica.php';

class EstadisticaBasica extends Estadistica
{
    public function calcularMedia(array $valores): float {
        return array_sum($valores) / count($valores);
    }

    public function calcularMediana(array $valores): float {
        sort($valores);
        $n = count($valores);
        $medio = (int) floor($n / 2);
        return $n % 2 !== 0
            ? $valores[$medio]
            : ($valores[$medio - 1] + $valores[$medio]) / 2;
    }

   public function calcularModa(array $valores): array {
    // Convertir todos los valores a strings
    $valoresStr = array_map(fn($v) => (string)$v, $valores);

    $frecuencia = array_count_values($valoresStr);
    $max = max($frecuencia);

    // Devolver como float para mantener consistencia
    return array_map('floatval', array_keys(array_filter($frecuencia, fn($v) => $v === $max)));
}


    public function generarInforme(): array {
        $informe = [];
        foreach ($this->datos as $grupo => $valores) {
            if (!is_array($valores) || count($valores) === 0) continue;

            $informe[$grupo] = [
                'media' => round($this->calcularMedia($valores), 2),
                'mediana' => round($this->calcularMediana($valores), 2),
                'moda' => $this->calcularModa($valores)
            ];
        }
        return $informe;
    }
}

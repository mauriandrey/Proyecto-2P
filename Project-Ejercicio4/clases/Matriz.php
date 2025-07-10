<?php
namespace Clases;

require_once __DIR__ . '/MatrizAbstracta.php';
require_once __DIR__ . '/MatrizOperaciones.php';

class Matriz extends MatrizAbstracta implements MatrizOperaciones {
  public function multiplicar(array $otra): array {
    $A = $this->matriz;
    $B = array_map(function($fila) {
      return array_map('floatval', $fila);
    }, $otra);

    $filasA = count($A);
    $colsA = count($A[0]);
    $filasB = count($B);
    $colsB = count($B[0]);

    if ($colsA !== $filasB) {
      throw new \Exception("Las matrices no se pueden multiplicar: columnas de A deben coincidir con filas de B.");
    }

    $res = [];
    for ($i = 0; $i < $filasA; $i++) {
      for ($j = 0; $j < $colsB; $j++) {
        $res[$i][$j] = 0;
        for ($k = 0; $k < $colsA; $k++) {
          $res[$i][$j] += $A[$i][$k] * $B[$k][$j];
        }
      }
    }
    return $res;
  }

  public function inversa(): array {
    return $this->inversaGaussJordan();
  }

  public function inversaGaussJordan(): array {
    $n = count($this->matriz);
    if ($n !== count($this->matriz[0])) {
      throw new \Exception("La matriz debe ser cuadrada para calcular la inversa.");
    }

    $aug = [];
    for ($i = 0; $i < $n; $i++) {
      $aug[$i] = array_merge($this->matriz[$i], array_fill(0, $n, 0));
      $aug[$i][$i + $n] = 1;
    }

    for ($i = 0; $i < $n; $i++) {
      $pivot = $aug[$i][$i];
      if ($pivot == 0) throw new \Exception("No se puede calcular la inversa (pivote cero).");

      for ($j = 0; $j < 2 * $n; $j++) $aug[$i][$j] /= $pivot;
      for ($k = 0; $k < $n; $k++) {
        if ($k === $i) continue;
        $factor = $aug[$k][$i];
        for ($j = 0; $j < 2 * $n; $j++) {
          $aug[$k][$j] -= $factor * $aug[$i][$j];
        }
      }
    }

    $inversa = [];
    for ($i = 0; $i < $n; $i++) {
      $inversa[] = array_slice($aug[$i], $n);
    }
    return $inversa;
  }
}

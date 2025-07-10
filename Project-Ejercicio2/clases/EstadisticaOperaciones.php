<?php
declare(strict_types=1);

namespace Clases;

interface EstadisticaOperaciones
{
    public function calcularMedia(array $valores): float;
    public function calcularMediana(array $valores): float;
    public function calcularModa(array $valores): array;
}

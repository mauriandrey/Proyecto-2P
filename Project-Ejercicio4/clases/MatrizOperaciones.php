<?php
declare(strict_types=1);

namespace Clases;

interface MatrizOperaciones {
    public function multiplicar(array $matriz): array;
    public function inversa(): array;
    public function determinante(): float;
} 
<?php
declare(strict_types=1);

namespace Clases;

require_once __DIR__ . '/EstadisticaOperaciones.php';

abstract class Estadistica implements EstadisticaOperaciones
{
    protected array $datos;

    public function __construct(array $datos)
    {
        $this->datos = $datos;
    }

   
}

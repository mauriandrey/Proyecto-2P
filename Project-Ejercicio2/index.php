<?php
declare(strict_types=1);

require_once __DIR__ . '/clases/EstadisticaOperaciones.php';
require_once __DIR__ . '/clases/Estadistica.php';
require_once __DIR__ . '/clases/EstadisticaBasica.php';

use Clases\EstadisticaBasica;

$resultado = null;

function validarNumeros(string $cadena): bool {
    $valores = array_filter(array_map('trim', explode(',', $cadena)));
    foreach ($valores as $valor) {
        if (!preg_match('/^-?\d+(\.\d{1,2})?$/', $valor)) {
            return false;
        }
    }
    return true;
}

$datos = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['calcular'])) {
    $nombres = $_POST['nombre'] ?? [];
    $valores = $_POST['valores'] ?? [];

    foreach ($nombres as $i => $nombre) {
        $nombre = trim($nombre);
        $cadena = trim($valores[$i]);

        if ($nombre === '' || $cadena === '') continue;

        if (!validarNumeros($cadena)) {
            $resultado = ['error' => "El conjunto \"$nombre\" contiene valores inválidos. Solo se permiten números con hasta 2 decimales."];
            break;
        }

        $numeros = array_map('floatval', explode(',', $cadena));
        $datos[$nombre] = $numeros;
    }

    if (empty($resultado) && count($datos) > 0) {
        try {
            $estadistica = new EstadisticaBasica($datos);
            $resultado = $estadistica->generarInforme();
        } catch (Throwable $e) {
            $resultado = ['error' => 'Error inesperado: ' . $e->getMessage()];
        }
    } elseif (empty($resultado)) {
        $resultado = ['error' => 'Debes ingresar al menos un conjunto con datos válidos.'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadísticas Básicas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h2>Calculadora de Estadísticas Básicas</h2>
    </header>

    <div class="container mb-4">
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
            <div class="col">
                <div class="card border-info mb-3 h-100" style="max-width: 18rem;">
                    <div class="card-header bg-primary text-light"><h4><strong>La Media</strong></h4></div>
                    <div class="card-body">
                        <h5 class="card-title">Definición</h5>
                        <p class="card-text">Es el valor promedio de un conjunto de datos.</p>
                        <h6 class="card-title text-primary">Cómo se calcula:</h6>
                        <p class="card-text">Suma todos los valores y divide por la cantidad de datos.</p>
                    </div>
                    <div class="card-footer bg-transparent border-success">
                        <strong>Ejemplo:</strong>
                        <p class="card-text">Si tienes los números 2, 4, 6, la media es (2 + 4 + 6) / 3 = 4.</p> 
                    </div>
                    </div> 
            </div>

            <div class="col">
                <div class="card border-info mb-3 h-100" style="max-width: 18rem;">
                    <div class="card-header bg-primary text-light"><h4><strong>La Mediana</strong></h4></div>
                    <div class="card-body">
                        <h5 class="card-title">Definición</h5>
                        <p class="card-text">Es el valor que se encuentra justo en el medio cuando los datos se ordenan de menor a mayor.</p>
                        <h6 class="card-title text-primary">Cómo se calcula:</h6>
                        <p class="card-text">Ordena los datos y selecciona el valor central.</p>
                    </div>
                    <div class="card-footer bg-transparent border-success">
                        <strong>Ejemplo:</strong>
                        <p class="card-text">Si tienes los números 1, 3, 4, la mediana es 3.</p> 
                         <p class="card-text">Si tienes 1, 2, 3, 4, la mediana es (2 + 3) / 2 = 2.5.</p>
                    </div>
                        
                </div> 
            </div>

            <div class="col">
                <div class="card border-info mb-3 h-100" style="max-width: 18rem;">
                    <div class="card-header bg-primary text-light"><h4><strong>La Moda</strong></h4></div>
                    <div class="card-body">
                        <h5 class="card-title">Definición</h5>
                        <p class="card-text">Es el valor que aparece con mayor frecuencia en un conjunto de datos.</p>
                        <h6 class="card-title text-primary">Cómo se calcula:</h6>
                        <p class="card-text">Identifica el número que se repite más veces.</p>
                    </div>
                    <div class="card-footer bg-transparent border-success">
                       <strong>Ejemplo:</strong> 
                     <p class="card-text">Si tienes los números 1, 2, 2, 3, la moda es 2.</p>
                    </div>
        
                    </div>  
             </div>
        </div>
</div>
<div class="container mb-4">
    <h3>Ingrese sus datos:</h3>
        <div class="alert alert-info">
            <strong><i class="bi bi-info-circle"></i>
            Instrucciones:</strong> Puedes ingresar hasta 5 conjuntos de datos. Especifica un nombre y los valores separados por comas. Puedes usar números con hasta 2 decimales.
        </div>

        <div class="alert alert-warning">
            <strong><i class="bi bi-exclamation-triangle"></i> Advertencia:</strong> Si ingresas un conjunto con valores inválidos, se mostrará un mensaje de error y no se calcularán las estadísticas.
        </div>
        
        <form method="post" onsubmit="return validarCliente();">
            <div id="conjuntos">
                <?php
                $nombres = $_POST['nombre'] ?? [''];
                $valores = $_POST['valores'] ?? [''];
                foreach ($nombres as $i => $nombre): ?>
                    <div class="row g-3 conjunto-item align-items-center mb-3">
                        <div class="col-12 col-md-4">
                            <input type="text" name="nombre[]" class="form-control"
                                placeholder="Nombre del conjunto"
                                value="<?= htmlspecialchars($nombre) ?>" required>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text" name="valores[]" class="form-control"
                                placeholder="Ej: 4.5, 3, 5, 5.75"
                                value="<?= htmlspecialchars($valores[$i] ?? '') ?>" required>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="row gy-2 gx-3 align-items-center flex-wrap mb-3">
                <div class="col-auto">
                    <button type="button" class="btn btn-outline-success" onclick="agregarConjunto()">
                        <strong><i class="bi bi-plus-circle"></i> Agregar Conjunto</strong>
                    </button>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-outline-warning" onclick="eliminarConjunto()">
                        <strong><i class="bi bi-dash-circle"></i> Eliminar Último</strong>
                    </button>
                </div>
                <div class="col-auto">
                    <button type="submit" name="calcular" class="btn btn-primary">
                        <strong><i class="bi bi-calculator-fill"></i> Calcular</strong>
                    </button>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger" onclick="limpiarFormulario()">
                        <strong><i class="bi bi-trash"></i> Limpiar Datos</strong>
                    </button>
                </div>
            </div>
        </form>

        <?php if ($resultado): ?>
            <?php if (isset($resultado['error'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($resultado['error']) ?></div>
            <?php else: ?>
                <div class="alert alert-success">
                    <h4>Resultados:</h4>
                    <ul>
                        <?php foreach ($resultado as $grupo => $estadisticas): ?>
                            <li>
                                <strong><?= htmlspecialchars($grupo) ?></strong>: 
                                Media = <?= $estadisticas['media'] ?>, 
                                Mediana = <?= $estadisticas['mediana'] ?>, 
                                Moda = [<?= implode(', ', array_map('htmlspecialchars', $estadisticas['moda'])) ?>]
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <footer class="footer mt-5">
        <div class="footer-section text-center">
            <p>Desarrollado por Mauri Tandazo </p>
            <p>© 2025 - Todos los derechos reservados</p>
        </div>
    </footer>

    <script src="assets/js/form-handler.js"></script>

</body>
</html>

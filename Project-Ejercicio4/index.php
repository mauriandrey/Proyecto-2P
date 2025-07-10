<?php
declare(strict_types=1);

require_once __DIR__ . '/clases/MatrizOperaciones.php';
require_once __DIR__ . '/clases/MatrizAbstracta.php';
require_once __DIR__ . '/clases/Matriz.php';

use Clases\Matriz;
$resultadosHTML = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $operacion = $_POST['operacion'] ?? '';
    $matrizA = $_POST['matrizA'] ?? [];
    $matrizB = $_POST['matrizB'] ?? [];

    try {
        // Validación básica para asegurar que matrizA no esté vacía antes de instanciar
        if (empty($matrizA) || !is_array($matrizA) || empty($matrizA[0])) {
            throw new Exception("La Matriz A no puede estar vacía.");
        }
        $objA = new Matriz($matrizA);

        switch ($operacion) {
            case 'determinante':
                $det = $objA->determinante();
                $resultadosHTML = "<div class='alert alert-success'><strong>Determinante:</strong> " . round($det, 2) . "</div>";
                break;

            case 'inversa':
                $inversa = $objA->inversaGaussJordan();
                $resultadosHTML = renderMatriz($inversa, 'Inversa de A');
                break;

            case 'multiplicar':
                // Validación básica para matrizB en caso de multiplicación
                if (empty($matrizB) || !is_array($matrizB) || empty($matrizB[0])) {
                    throw new Exception("La Matriz B no puede estar vacía para la multiplicación.");
                }
                $producto = $objA->multiplicar($matrizB);
                $resultadosHTML = renderMatriz($producto, 'A × B');
                break;
            default:
                $resultadosHTML = "<div class='alert alert-warning'>Operación no válida.</div>";
                break;
        }
    } catch (Throwable $e) {
        $resultadosHTML = "<div class='alert alert-danger'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}

function renderMatriz(array $matriz, string $titulo): string {
    $html = "<div class='mt-4'><h5>$titulo</h5><table class='table table-bordered text-center w-auto'>";
    foreach ($matriz as $fila) {
        $html .= "<tr>";
        foreach ($fila as $valor) {
            $html .= "<td>" . round((float)$valor, 2) . "</td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table></div>";
    return $html;
}
?>
<script>
// Este script PHP incrustado asegura que los resultados de PHP se muestren en la página
// después de un POST sin necesidad de recargar toda la página desde cero para el JS.
document.addEventListener("DOMContentLoaded", () => {
    const resultadosDiv = document.getElementById("resultados");
    if (resultadosDiv) { // Verificar si el elemento existe
        resultadosDiv.innerHTML = `<?= $resultadosHTML ?>`;
    }
});
</script>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Operaciones con Matrices</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <h2>Operaciones con Matrices</h2>
    </header>

    <div class="container mb-4">
        <section class="mb-4">
            <div class="alert alert-info">
                <strong>Operaciones disponibles:</strong>
                <ul>
                    <li><strong>Determinante:</strong> Requiere matriz cuadrada</li>
                    <li><strong>Inversa (Gauss-Jordan):</strong> Matriz cuadrada con determinante distinto de cero</li>
                    <li><strong>Multiplicación:</strong> A × B con dimensiones compatibles</li>
                </ul>
                <p><em>Ejemplo (2x2):</em> a11, a12, a21, a22</p>
            </div>
        </section>
    </div>   
    <div class="container mb-4">
        <h2 class="text-primary">Ingreso de datos:</h2>
        <form method="post" id="form-matrices">
            <section class="mb-4">
                <h5>Matriz A</h5>
                <div class="row g-2 align-items-center mb-3">
                    <div class="col-auto">
                        <input type="number" min="1" max="4" id="filas" class="form-control" placeholder="Filas A">
                    </div>
                    <div class="col-auto">
                        <input type="number" min="1" max="4" id="columnas" class="form-control" placeholder="Columnas A">
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" id="btn-crear-matriz-a">
                            <i class="bi bi-grid-3x3-gap"></i> Crear Matriz A
                        </button>
                    </div>
                </div>
                <section id="matriz-a-container" class="mb-4"></section>
            </section>

            <div class="mb-3">
                <label for="operacion" class="form-label">Operación:</label>
                <select class="form-select w-auto" name="operacion" id="operacion" required>
                    <option value="determinante">Calcular Determinante</option>
                    <option value="inversa">Calcular Inversa (Gauss-Jordan)</option>
                    <option value="multiplicar">Multiplicar Matrices (A × B)</option>
                </select>
            </div>

            <section id="matriz-b-container" class="mb-4" style="display: none;">
                <h5>Matriz B</h5>
                <div class="row g-2 align-items-center mb-3">
                    <div class="col-auto">
                        <input type="number" min="1" max="4" id="filasB" class="form-control" placeholder="Filas B">
                    </div>
                    <div class="col-auto">
                        <input type="number" min="1" max="4" id="columnasB" class="form-control" placeholder="Columnas B">
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" id="btn-crear-matriz-b">
                            <i class="bi bi-grid-3x3-gap"></i> Crear Matriz B
                        </button>
                    </div>
                </div>
                <div id="contenedor-b"></div>
            </section>

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-success" id="btn-calcular">
                    <i class="bi bi-play-circle"></i> Calcular
                </button>
                <button type="button" class="btn btn-danger" id="btn-limpiar">
                    <i class="bi bi-x-circle"></i> Limpiar
                </button>
            </div>
        </form>
    </div>
    <div class="container mb-4">
        <h2 class="text-primary">Resultados apareceran aqui:</h2>
        <section id="resultados" class="mt-4"></section>
    </div>

   <footer class="footer mt-5">
        <div class="footer-section text-center">
            <p>Desarrollado por Mauri Tandazo </p>
            <p>© 2025 - Todos los derechos reservados</p>
        </div>
    </footer>

    <script src="assets/js/validador.js"></script>
</body>
</html>
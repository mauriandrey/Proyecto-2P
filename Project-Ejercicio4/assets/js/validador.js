document.addEventListener("DOMContentLoaded", () => {
    // Obtenemos referencias a los elementos del DOM
    const operacionSelect = document.getElementById("operacion");
    const matrizBSection = document.getElementById("matriz-b-container");
    const btnLimpiar = document.getElementById("btn-limpiar");
    const btnCrearMatrizA = document.getElementById("btn-crear-matriz-a"); // Botón para Matriz A
    const btnCrearMatrizB = document.getElementById("btn-crear-matriz-b"); // Botón para Matriz B
    const btnCalcular = document.getElementById("btn-calcular");
    const matrizAContainer = document.getElementById("matriz-a-container");
    const resultados = document.getElementById("resultados");

    // Inputs para las dimensiones de Matriz A
    const filasAInput = document.getElementById("filas");
    const columnasAInput = document.getElementById("columnas");

    // Inputs para las dimensiones de Matriz B
    const filasBInput = document.getElementById("filasB");
    const columnasBInput = document.getElementById("columnasB");
    const contenedorB = document.getElementById("contenedor-b");

    // --- Funciones de Utilidad ---
    /**
     * Muestra u oculta la sección de Matriz B y limpia sus inputs si se oculta.
     */
    function toggleMatrizBVisibility() {
        if (operacionSelect.value === "multiplicar") {
            matrizBSection.style.display = "block";
        } else {
            matrizBSection.style.display = "none";
            contenedorB.innerHTML = ""; // Limpia los inputs de la matriz B si se oculta
        }
    }

    /**
     * Genera dinámicamente los campos de entrada para una matriz.
     * @param {string} id - 'a' para Matriz A, 'b' para Matriz B.
     * @param {number} filas - Número de filas.
     * @param {number} columnas - Número de columnas.
     */
    function generarMatrizInputs(id, filas, columnas) {
        const contenedor = document.getElementById(id === "a" ? "matriz-a-container" : "contenedor-b");
        contenedor.innerHTML = "";

        for (let i = 0; i < filas; i++) {
            const fila = document.createElement("div");
            fila.classList.add("d-flex", "gap-2", "mb-2");

            for (let j = 0; j < columnas; j++) {
                const input = document.createElement("input");
                input.type = "text";
                input.name = `matriz${id.toUpperCase()}[${i}][${j}]`;
                input.placeholder = `${i + 1},${j + 1}`;
                input.classList.add("form-control", "text-center");
                input.pattern = "[-+]?[0-9]*[.,]?[0-9]+"; 
                input.title = "Solo números (decimales con punto o coma)";
                fila.appendChild(input);
            }
            contenedor.appendChild(fila);
        }
    }

    // --- Event Listeners ---

    // 1. Cuando cambia la operación seleccionada
    operacionSelect.addEventListener("change", () => {
        toggleMatrizBVisibility();
        // Limpiar matrices existentes cuando cambia la operación
        matrizAContainer.innerHTML = "";
        contenedorB.innerHTML = "";
        resultados.innerHTML = ""; // Limpiar resultados también
    });

    // 2. Al cargar la página, establece la visibilidad inicial de Matriz B
    toggleMatrizBVisibility();

    // 3. Cuando se hace clic en el botón "Limpiar"
    btnLimpiar.addEventListener("click", () => {
        document.getElementById("form-matrices").reset();
        matrizAContainer.innerHTML = "";
        contenedorB.innerHTML = "";
        resultados.innerHTML = "";
        toggleMatrizBVisibility();
    });

    // 4. Cuando se hace clic en el botón "Crear Matriz A"
    btnCrearMatrizA.addEventListener("click", () => {
        resultados.innerHTML = ""; // Limpiar resultados anteriores

        const filasA = parseInt(filasAInput.value);
        const columnasA = parseInt(columnasAInput.value);

        if (isNaN(filasA) || isNaN(columnasA) || filasA < 1 || filasA > 4 || columnasA < 1 || columnasA > 4) {
            alert("Por favor, ingresa un número de filas y columnas para la Matriz A entre 1 y 4.");
            matrizAContainer.innerHTML = "";
            return;
        }
        generarMatrizInputs("a", filasA, columnasA);
    });

    // 5. Cuando se hace clic en el botón "Crear Matriz B"
    btnCrearMatrizB.addEventListener("click", () => {
        resultados.innerHTML = ""; // Limpiar resultados anteriores

        // Asegurarse de que la operación actual sea multiplicación para generar Matriz B
        if (operacionSelect.value !== "multiplicar") {
            alert("La Matriz B solo se puede crear para la operación de Multiplicación.");
            contenedorB.innerHTML = ""; // Asegurarse de que esté vacía
            return;
        }

        const filasB = parseInt(filasBInput.value);
        const columnasB = parseInt(columnasBInput.value);

        if (isNaN(filasB) || isNaN(columnasB) || filasB < 1 || filasB > 4 || columnasB < 1 || columnasB > 4) {
            alert("Por favor, ingresa un número de filas y columnas para la Matriz B entre 1 y 4.");
            contenedorB.innerHTML = "";
            return;
        }

        // Validación de compatibilidad para la multiplicación de matrices (colA == filasB)
        const filasA = parseInt(filasAInput.value);
        const columnasA = parseInt(columnasAInput.value);

        // Si Matriz A no ha sido generada o sus dimensiones son inválidas, alertar.
        if (isNaN(filasA) || isNaN(columnasA) || filasA < 1 || filasA > 4 || columnasA < 1 || columnasA > 4) {
             alert("Por favor, define y crea la Matriz A primero para validar la compatibilidad de la multiplicación.");
             contenedorB.innerHTML = "";
             return;
        }

        if (columnasA !== filasB) {
            alert("Para la multiplicación de matrices, el número de columnas de la Matriz A (" + columnasA + ") debe ser igual al número de filas de la Matriz B (" + filasB + ").");
            contenedorB.innerHTML = "";
            return;
        }

        generarMatrizInputs("b", filasB, columnasB);
        matrizBSection.style.display = "block"; // Asegurarse de que Matriz B se muestre
    });

    // 6. Cuando se hace clic en el botón "Calcular" (solo para enviar el formulario)
    btnCalcular.addEventListener("click", (event) => {
        // Opcional: Podrías añadir una validación aquí para asegurarte de que ambas matrices
        // tienen inputs generados antes de enviar el formulario.
        // Por ejemplo: if (matrizAContainer.innerHTML === "" || (operacionSelect.value === "multiplicar" && contenedorB.innerHTML === "")) { alert("Primero crea las matrices."); event.preventDefault(); return; }

        // El formulario se enviará y PHP procesará los datos.
        // No hay preventDefault() aquí para que el formulario se envíe normalmente.
    });
});
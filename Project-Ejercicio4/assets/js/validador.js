document.addEventListener("DOMContentLoaded", () => {
    // Obtenemos referencias a los elementos del DOM
    const operacionSelect = document.getElementById("operacion");
    const matrizBSection = document.getElementById("matriz-b-container");
    const btnLimpiar = document.getElementById("btn-limpiar");
    const btnCrearMatrizA = document.getElementById("btn-crear-matriz-a");
    const btnCrearMatrizB = document.getElementById("btn-crear-matriz-b");
    const btnCalcular = document.getElementById("btn-calcular");
    const matrizAContainer = document.getElementById("matriz-a-container");
    const resultados = document.getElementById("resultados");

    const filasAInput = document.getElementById("filas");
    const columnasAInput = document.getElementById("columnas");
    const filasBInput = document.getElementById("filasB");
    const columnasBInput = document.getElementById("columnasB");
    const contenedorB = document.getElementById("contenedor-b");

    function toggleMatrizBVisibility() {
        if (operacionSelect.value === "multiplicar") {
            matrizBSection.style.display = "block";
        } else {
            matrizBSection.style.display = "none";
            contenedorB.innerHTML = "";
        }
    }

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

    operacionSelect.addEventListener("change", () => {
        toggleMatrizBVisibility();
        matrizAContainer.innerHTML = "";
        contenedorB.innerHTML = "";
        resultados.innerHTML = "";
    });

    toggleMatrizBVisibility();

    btnLimpiar.addEventListener("click", () => {
        document.getElementById("form-matrices").reset();
        matrizAContainer.innerHTML = "";
        contenedorB.innerHTML = "";
        resultados.innerHTML = "";
        toggleMatrizBVisibility();
    });

    btnCrearMatrizA.addEventListener("click", () => {
        resultados.innerHTML = "";

        const filasA = parseInt(filasAInput.value);
        const columnasA = parseInt(columnasAInput.value);

        if (isNaN(filasA) || isNaN(columnasA) || filasA < 1 || filasA > 4 || columnasA < 1 || columnasA > 4) {
            alert("Por favor, ingresa un número de filas y columnas para la Matriz A entre 1 y 4.");
            matrizAContainer.innerHTML = "";
            return;
        }
        generarMatrizInputs("a", filasA, columnasA);
    });

    btnCrearMatrizB.addEventListener("click", () => {
        resultados.innerHTML = "";

        if (operacionSelect.value !== "multiplicar") {
            alert("La Matriz B solo se puede crear para la operación de Multiplicación.");
            contenedorB.innerHTML = "";
            return;
        }

        const filasB = parseInt(filasBInput.value);
        const columnasB = parseInt(columnasBInput.value);

        if (isNaN(filasB) || isNaN(columnasB) || filasB < 1 || filasB > 4 || columnasB < 1 || columnasB > 4) {
            alert("Por favor, ingresa un número de filas y columnas para la Matriz B entre 1 y 4.");
            contenedorB.innerHTML = "";
            return;
        }

        const filasA = parseInt(filasAInput.value);
        const columnasA = parseInt(columnasAInput.value);

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
        matrizBSection.style.display = "block";
    });

    btnCalcular.addEventListener("click", (event) => {
        if (matrizAContainer.innerHTML === "") {
            alert("Primero debes crear la Matriz A.");
            event.preventDefault();
            return;
        }
        if (operacionSelect.value === "multiplicar" && contenedorB.innerHTML === "") {
            alert("Primero debes crear la Matriz B para realizar la multiplicación.");
            event.preventDefault();
            return;
        }
    });
});

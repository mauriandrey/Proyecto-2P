let maxConjuntos = 5;
let totalConjuntos = document.querySelectorAll('.conjunto-item').length || 1;

function agregarConjunto() {
    if (totalConjuntos >= maxConjuntos) {
        alert("Solo se permiten hasta 5 conjuntos de datos.");
        return;
    }

    const contenedor = document.getElementById('conjuntos');

    const div = document.createElement('div');
    div.className = 'mb-3 row conjunto-item';
    div.innerHTML = `
        <div class="col-md-4">
            <input type="text" name="nombre[]" class="form-control" placeholder="Nombre del conjunto" required>
        </div>
        <div class="col-md-8">
            <input type="text" name="valores[]" class="form-control" placeholder="Ej: 4.5, 3, 5, 5.75" required>
        </div>
    `;
    contenedor.appendChild(div);
    totalConjuntos++;
}

function eliminarConjunto() {
    const contenedor = document.getElementById('conjuntos');
    const items = contenedor.getElementsByClassName('conjunto-item');

    if (items.length > 1) {
        contenedor.removeChild(items[items.length - 1]);
        totalConjuntos--;
    } else {
        alert("Debe haber al menos un conjunto de datos.");
    }
}

function limpiarFormulario() {
    location.href = location.pathname;
}

function validarCliente() {
    const inputs = document.querySelectorAll('input[name="valores[]"]');
    const regex = /^-?\d+(\.\d{1,2})?(,\s*-?\d+(\.\d{1,2})?)*$/;

    for (let input of inputs) {
        if (input.value.trim() !== '' && !regex.test(input.value.trim())) {
            alert("Uno de los conjuntos tiene datos inválidos. Usa solo números separados por comas.");
            input.focus();
            return false;
        }
    }
    return true;
}

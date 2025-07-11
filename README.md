# Proyecto-2P
Ejercicios 2 y 4 del Laboratorio Introducción a la Programación en PHP + Interfaz Grafica 

#

# 📊 Project-Ejercicio2 — Estadísticas Básicas en PHP

Este proyecto permite calcular estadísticas básicas (media, mediana y moda) de hasta 5 conjuntos de datos ingresados por el usuario a través de una interfaz gráfica construida con PHP, HTML, Bootstrap y JavaScript.

## 🧾 Descripción

El sistema implementa los principios SOLID de programación orientada a objetos en PHP, utilizando:

- Tipado fuerte (`strict_types=1`)
- Interfaces (`EstadisticaOperaciones`)
- Clases abstractas (`Estadistica`)
- Clases hijas (`EstadisticaBasica`)
- Estructura modular por carpetas
- Validaciones del lado del cliente y servidor

## 🎯 Funcionalidades

- Ingreso dinámico de hasta **5 conjuntos de datos numéricos**
- Ingreso de **nombres personalizados para cada conjunto**
- Cálculo automático de:
  - **Media**
  - **Mediana**
  - **Moda**
- Validaciones:
  - Solo se aceptan **números enteros o decimales (hasta 2 cifras)**
  - Alertas de error claras
- Botones:
  - ➕ Agregar conjunto
  - ➖ Eliminar último conjunto
  - 📉 Calcular
  - 🔁 Limpiar formulario

## 🧱 Estructura del proyecto
```
Project-Ejercicio2/
 ├── index.php # Interfaz principal
 ├── clases/
 │ ├── EstadisticaOperaciones.php
 │ ├── Estadistica.php
 │ └── EstadisticaBasica.php
 └── assets/
 │   ├── css/
 │   └── styles.css  
 │   ├──js/
 │   └──form-handler.js # Lógica JS para la interfaz dinámica
```
## ✅ Tecnologías usadas

- PHP 8.x (tipado estricto)
- Bootstrap 5.3 (diseño responsivo)
- JavaScript (dinamismo del formulario)
- HTML5
- CSS3

## ▶️ Instrucciones de uso

1. Clona o descarga este repositorio en tu servidor local (ej. XAMPP o Laragon).
2. Abre el navegador y accede a `http://localhost/Project-Ejercicio2/index.php`
3. En la interfaz:
   - Escribe un nombre para el conjunto (ej. `Grupo A`)
   - Escribe los datos separados por comas (ej. `5, 6.75, 3, 3`)
   - Agrega más conjuntos si deseas (hasta 5)
   - Haz clic en `Calcular` para ver los resultados

## 📂 Recomendaciones

- Mantén la carpeta `assets/js/` para separar la lógica del cliente.
- Valida que PHP esté configurado con `display_errors=On` durante desarrollo.
- Puedes usar un autoloader (`spl_autoload_register`) si expandes el sistema.

#

# 📐 Project-Ejercicio4 — Operaciones con Matrices en PHP

Este proyecto permite realizar operaciones matemáticas con matrices de hasta 4x4, utilizando una interfaz web interactiva construida con PHP, Bootstrap y JavaScript. 

## 🎯 Funcionalidades

- Cálculo de:
  - ✅ Determinante (solo matrices cuadradas)
  - ✅ Inversa por Eliminación Gauss-Jordan (matriz cuadrada con determinante ≠ 0)
  - ✅ Multiplicación de matrices A × B (compatibilidad de dimensiones)

- Ingreso dinámico de matrices A y B
- Selección de filas y columnas (1 a 4)
- Validaciones completas de compatibilidad y tipo numérico
- Estilo responsivo con Bootstrap 5 y Bootstrap Icons
- Separación de lógica JS en archivo externo (`validador.js`)

## 🧱 Estructura del proyecto

```
 Project-Ejercicio4/
├── index.php                   # Interfaz principal
├── clases/                    # Clases PHP
│   ├── MatrizOperaciones.php
│   ├── MatrizAbstracta.php
│   └── Matriz.php
├── assets/
│   ├── css/
│   │   └── styles.css         
│   └── js/
│       └── validador.js        # JS con validaciones y generación de matrices
└── README.md
```

## 🧠 Tecnologías utilizadas

- PHP 8.x con tipado fuerte (`declare(strict_types=1);`)
- Bootstrap 5.3 para la interfaz
- Bootstrap Icons para iconografía
- JavaScript modular para dinámica del formulario

## ▶️ Instrucciones de uso

1. Clona o descarga el proyecto en tu entorno local (XAMPP, Laragon, etc.)
2. Asegúrate de tener PHP habilitado
3. Abre `http://localhost/Project-Ejercicio4/index.php`
4. Selecciona el número de filas y columnas para la Matriz A y opcionalmente para Matriz B
5. Ingresa los datos numéricos en los campos generados
6. Selecciona la operación y haz clic en **Calcular**

## 💡 Validaciones importantes

- Solo se aceptan valores numéricos (decimales con punto o coma)
- Las matrices deben ser compatibles según la operación seleccionada
- Si el usuario elige Multiplicación, debe crear ambas matrices con dimensiones válidas


## 🧠 Créditos

- Universidad de las Fuerzas Armadas ESPE  
- Docente: Geovanny Cudco  
- Desarrollado por: Mauri Tandazo

---

**Fecha límite de entrega:** 10 de julio de 2025



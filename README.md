# Proyecto-2P
Ejercicios 2 y 4 del Laboratorio Introducción a la Programación en PHP + Interfaz Grafica 

# 📊 Project-Ejercicio2 — Estadísticas Básicas en PHP

Este proyecto permite calcular estadísticas básicas (media, mediana y moda) de hasta 5 conjuntos de datos ingresados por el usuario a través de una interfaz gráfica construida con PHP, HTML, Bootstrap y JavaScript.

## 🧾 Descripción

El sistema implementa los principios SOLID de programación orientada a objetos en PHP, utilizando:

- Tipado fuerte (`strict_types=1`)
- Interfaces (`EstadisticaInterface`)
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

-Project-Ejercicio2/
-├── index.php # Interfaz principal
-├── clases/
-│ ├── EstadisticaInterface.php
-│ ├── Estadistica.php
-│ └── EstadisticaBasica.php
-└── assets/
-└── js/
-└── form-handler.js # Lógica JS para la interfaz dinámica

## ✅ Tecnologías usadas

- PHP 8.x (tipado estricto)
- Bootstrap 5.3 (diseño responsivo)
- JavaScript (dinamismo del formulario)
- HTML5
- CSS3 (opcional)

## ▶️ Instrucciones de uso

1. Clona o descarga este repositorio en tu servidor local (ej. XAMPP o Laragon).
2. Abre el navegador y accede a `http://localhost/Project-Ejercicio2/index.php`
3. En la interfaz:
   - Escribe un nombre para el conjunto (ej. `Grupo A`)
   - Escribe los datos separados por comas (ej. `5, 6.75, 3, 3`)
   - Agrega más conjuntos si deseas (hasta 5)
   - Haz clic en `Calcular` para ver los resultados

## 📸 Capturas

> *(Agrega aquí imágenes del formulario y resultados si es un proyecto público o para presentación.)*

## 📂 Recomendaciones

- Mantén la carpeta `assets/js/` para separar la lógica del cliente.
- Valida que PHP esté configurado con `display_errors=On` durante desarrollo.
- Puedes usar un autoloader (`spl_autoload_register`) si expandes el sistema.

## 🧠 Créditos

- Universidad de las Fuerzas Armadas ESPE  
- Docente: Geovanny Cudco  
- Desarrollado por: Mauri Tandazo

---

**Fecha límite de entrega:** 10 de julio de 2025



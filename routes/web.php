<?php

use Illuminate\Support\Facades\Route;

 Route::get('/', function () {
     return view('welcome');
 });

/*
|--------------------------------------------------------------------------
| Rutas Web Demo Avanzadas para Laravel 12
|--------------------------------------------------------------------------
|
| Aquí tienes ejemplos de rutas básicas y variantes avanzadas para entender
| cómo funcionan los parámetros, opciones y validaciones con expresiones regulares.
| Cada ruta devuelve un texto simple para que sea fácil de seguir.
|
*/

// Ruta GET simple, sin parámetros
Route::get('/saludo', function () {
    return "Hola! Ruta GET básica, sin parámetros.";
});

// Ruta GET con parámetro obligatorio (ejemplo: /usuario/5)
Route::get('/usuario/{id}', function ($id) {
    return "Ruta GET con parámetro obligatorio. Usuario ID: $id";
});

// Ruta GET con parámetro obligatorio con restricción (solo números)
Route::get('/producto/{codigo}', function ($codigo) {
    return "Producto con código numérico: $codigo";
})->where('codigo', '[0-9]+');  // solo números

// Ruta GET con parámetro obligatorio con restricción letras (minúsculas)
Route::get('/categoria/{nombre}', function ($nombre) {
    return "Categoría con nombre solo letras minúsculas: $nombre";
})->where('nombre', '[a-z]+');  // solo letras minúsculas

// Ruta GET con parámetro obligatorio que sigue un patrón específico (ejemplo: letras-números guión bajo)
Route::get('/registro/{ref}', function ($ref) {
    return "Referencia válida: $ref";
})->where('ref', '[A-Za-z0-9_-]+'); // letras, números, guiones y guion bajo

// Ruta GET con parámetro opcional (ejemplo: /perfil o /perfil/juan)
Route::get('/perfil/{usuario?}', function ($usuario = 'Invitado') {
    return "Perfil de usuario: $usuario";
});

// Ruta GET con múltiples parámetros y validaciones combinadas
Route::get('/orden/{id}/{codigo}', function ($id, $codigo) {
    return "Orden $id con código $codigo";
})->where([
    'id' => '[0-9]+',       // id solo números
    'codigo' => '[A-Z]{3}[0-9]{3}'  // código 3 letras mayúsculas + 3 números, ej: ABC123
]);

// Ruta POST para enviar datos (no visible desde navegador, usar Postman o curl)
Route::post('/enviar-datos', function () {
    return "Ruta POST para enviar datos (crear recurso)";
});

// Ruta PUT para actualizar recurso completo
Route::put('/actualizar-recurso', function () {
    return "Ruta PUT para actualizar recurso completo";
});

// Ruta PATCH para actualizar parcialmente
Route::patch('/actualizar-parcial', function () {
    return "Ruta PATCH para actualizar parcialmente";
});

// Ruta DELETE para eliminar recurso
Route::delete('/borrar-recurso', function () {
    return "Ruta DELETE para eliminar recurso";
});

// Ruta MATCH que acepta GET y POST
Route::match(['get', 'post'], '/buscar', function () {
    return "Ruta MATCH que acepta GET y POST";
});

// Ruta ANY que acepta cualquier método HTTP
Route::any('/cualquier-metodo', function () {
    return "Ruta ANY que acepta cualquier método HTTP";
});

/*
|--------------------------------------------------------------------------
| Ejemplo de Grupo de Rutas con Prefijo y Middleware (muy común en apps Laravel)
|--------------------------------------------------------------------------
|
| Aquí un grupo que aplica prefijo '/admin' a todas sus rutas
| y además un middleware ficticio 'auth' para autenticación.
| Por ahora solo es un ejemplo para cuando lo estudien más adelante.
|
*/
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return "Panel de administración (requiere estar autenticado)";
    });

    Route::get('/usuarios', function () {
        return "Listado de usuarios en admin";
    });
});


/**
 * Cómo probar:
        -Prueba en el navegador las rutas GET sin parámetros o con parámetros en la URL, por ejemplo:

        http://localhost:8000/saludo

        http://localhost:8000/usuario/42

        http://localhost:8000/perfil

        http://localhost:8000/perfil/juan

        http://localhost:8000/producto/12345

        http://localhost:8000/categoria/tecnologia

        http://localhost:8000/orden/55/ABC123

        -Para rutas POST, PUT, PATCH, DELETE, usa Postman o curl para enviar la solicitud.
 * 
 */

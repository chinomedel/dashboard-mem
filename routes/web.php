<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* Los Route tienen dos argumento el primero es la ruta y el segundo el contralador que controla la ruta
ej: Route::get("/blog", NombreControladorDeLaRuta);
La Route::view se utiliza para páginas estáticas, es decir, no necesita ningun controlador ya que no va 
a buscar ningún dato al modelo.
*/
/* 
Route::get('/', function () {
    return view('welcome');
});
*/
//Hace lo mismo que el código anterior, pero mas corto
Route::view('/', 'welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

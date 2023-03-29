<?php
/**
 * @OA\Info(
 *     title="Teste Idez",
 *     version="1.0.0",
 *     description="Projeto para teste",
 *     @OA\Contact(
 *         email="alana_francino@hotmail.com"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MunicipiosController;
    
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MunicipiosController::class, 'Index']);

Route::get('/municipios/{uf}', [MunicipiosController::class, 'municipiosPorUf']);

Route::get('/municipiosList', [MunicipiosController::class, 'listarMunicipiosPaginados'])->name('municipios.paginados');


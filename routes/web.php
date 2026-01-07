<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\MotivoBajaController;
use App\Http\Controllers\TipoEquipoController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\SalidaRevisionController;
use App\Http\Controllers\BajaInventarioController;




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

Route::get('/', function () {
    return view('inicio');
});

Route::get('/dashboard', function () {
    return view('inicio');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/modelos-por-tipo/{id}', [EquipoController::class, 'getModelosPorTipo']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/', function () {
        return view('inicio');
    });
    Route::get('equipo/grafico',[EquipoController::class, 'grafico'])->name('equipo.grafico');
    Route::get('equipo/grafico-anio', [EquipoController::class, 'graficoPorAnio'])->name('equipo.grafico_anio');

    Route::resource('/usuario',UsuarioController::class);
    Route::resource('/persona',PersonaController::class);
    Route::resource('/ciudad',CiudadController::class);
    Route::resource('/cargo',CargoController::class);
    Route::resource('/modelo',ModeloController::class);
    Route::resource('/proveedor',ProveedorController::class);
    Route::resource('/motivo_baja',MotivoBajaController::class);
    Route::resource('/tipo_equipo',TipoEquipoController::class);
    Route::resource('/marca',MarcaController::class);
    Route::resource('/area',AreaController::class);
    Route::resource('/permiso',PermissionController::class);
    Route::resource('/rol',RoleController::class);
    Route::resource('/empleado',EmpleadoController::class);
    Route::resource('/equipo',EquipoController::class);
    Route::resource('/inventario',InventarioController::class);
    Route::resource('/asignacion',AsignacionController::class);
    Route::resource('/salida_revision',SalidaRevisionController::class);
    Route::resource('/bajainventario',BajaInventarioController::class);



    Route::get('usuario/{id}/reset_password',[UsuarioController::class, 'reset_password'])->name('usuario.reset_password');

    Route::get('usuario/{id}/destroy',[UsuarioController::class, 'destroy'])->name('usuario.destroy');
    Route::get('persona/{id}/destroy',[PersonaController::class, 'destroy'])->name('persona.destroy');
    Route::get('cargo/{id}/destroy',[CargoController::class, 'destroy'])->name('cargo.destroy');
    Route::get('ciudad/{id}/destroy',[CiudadController::class, 'destroy'])->name('ciudad.destroy');
    Route::get('modelo/{id}/destroy',[ModeloController::class, 'destroy'])->name('modelo.destroy');
    Route::get('motivo_baja/{id}/destroy',[MotivoBajaController::class, 'destroy'])->name('motivo_baja.destroy');
    Route::get('proveedor/{id}/destroy',[ProveedorController::class, 'destroy'])->name('proveedor.destroy');
    Route::get('tipo_equipo/{id}/destroy',[TipoEquipoController::class, 'destroy'])->name('tipo_equipo.destroy');
    Route::get('area/{id}/destroy',[AreaController::class, 'destroy'])->name('area.destroy');
    Route::get('marca/{id}/destroy',[MarcaController::class, 'destroy'])->name('marca.destroy');
    Route::get('permiso/{id}/destroy',[PermissionController::class, 'destroy'])->name('permiso.destroy');
    Route::get('rol/{id}/destroy',[RoleController::class, 'destroy'])->name('rol.destroy');
    Route::get('empleado/{id}/destroy',[EmpleadoController::class, 'destroy'])->name('empleado.destroy');
    Route::get('equipo/{id}/destroy',[EquipoController::class, 'destroy'])->name('equipo.destroy');
    Route::get('inventario/{id}/destroy',[InventarioController::class, 'destroy'])->name('inventario.destroy');
    Route::get('asignacion/{id}/destroy',[AsignacionController::class, 'destroy'])->name('asignacion.destroy');
    Route::get('salida_revision/{id}/destroy',[SalidaRevisionController::class, 'destroy'])->name('salida_revision.destroy');
    Route::get('bajainventario/{id}/destroy',[BajaInventarioController::class, 'destroy'])->name('bajainventario.destroy');

    

    Route::post('asignacion/storeDetalle',[AsignacionController::class, 'storeDetalle'])->name('asignacion.storeDetalle');
    Route::get('asignacion/{id}/cancelar',[AsignacionController::class, 'cancelar'])->name('asignacion.cancelar');
    Route::get('asignacion/{id}/destroyDetalle',[AsignacionController::class, 'destroyDetalle'])->name('asignacion.destroyDetalle');

    Route::get('asignacion/{id}/notaAsignacion',[AsignacionController::class, 'notaAsignacion'])->name('asignacion.notaAsignacion');
    Route::get('asignacion/listado/asignaciones', [AsignacionController::class, 'listadoAsignaciones'])->name('asignacion.listado.asignaciones');
    Route::get('asignacion/filtros-por-empleado', [AsignacionController::class, 'filtrosPorEmpleado'])->name('asignacion.filtros_por_empleado');
    Route::get('asignacion/tipos-por-empleado', [App\Http\Controllers\AsignacionController::class, 'tiposPorEmpleado'])->name('asignacion.tipos_por_empleado');
    Route::get('asignacion/equipos-por-tipo', [App\Http\Controllers\AsignacionController::class, 'equiposPorTipo'])->name('asignacion.equipos_por_tipo');
    Route::get('asignacion/exportar/pdf', [AsignacionController::class, 'exportarPDF'])->name('asignacion.exportar_pdf');
    

    Route::post('rol/permiso',[RoleController::class, 'permiso'])->name('rol.permiso');
    Route::post('usuario/asignar_roles',[UsuarioController::class, 'asignar_roles'])->name('usuario.asignar_roles');
    
    
});


require __DIR__.'/auth.php';

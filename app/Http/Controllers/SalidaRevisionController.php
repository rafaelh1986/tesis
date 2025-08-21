<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SalidaRevision;
use App\Models\Inventario;
use App\Models\Proveedor;

class SalidaRevisionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['permission:salida_revision.index'])->only('index');
        $this->middleware(['permission:salida_revision.create'])->only('create');
        $this->middleware(['permission:salida_revision.store'])->only('store');
        $this->middleware(['permission:salida_revision.edit'])->only('edit');
        $this->middleware(['permission:salida_revision.update'])->only('update');
        $this->middleware(['permission:salida_revision.destroy'])->only('destroy');
        $this->middleware(['permission:salida_revision.show'])->only('show');
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $salidarevisiones = SalidaRevision::paginate($perPage);
        return view('admin/salidarevision/index', compact('salidarevisiones', 'perPage'));
    }
    public function create()
    {
        $inventarios = Inventario::where('estado', 1)->get();
        $proveedores = Proveedor::where('estado', 1)->get();
        return view('admin/salidarevision/create')->with('proveedores', $proveedores)->with('inventarios', $inventarios);
    }
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'id_inventario' => 'required|exists:inventarios,id',
            'id_proveedor' => 'required|exists:proveedores,id',
            'fecha_salida' => 'required|date',

        ]);
        $salidarevision = new SalidaRevision();
        $salidarevision->id_inventario = $request->id_inventario;
        $salidarevision->id_proveedor = $request->id_proveedor;
        $salidarevision->fecha_salida = $request->fecha_salida;
        $salidarevision->descripcion = $request->descripcion;
        $salidarevision->fecha_retorno = $request->fecha_retorno;
        $salidarevision->observaciones = $request->observaciones;
        $salidarevision->save();
        // Cambiar el estado del inventario a 3 (No disponible)
        $inventario = Inventario::find($request->id_inventario);
        if ($inventario) {
            $inventario->estado = 3;
            $inventario->save();
        }
        return redirect()->route('salida_revision.index')->with('success', '¡Creado Satisfactoriamente!');
    }
    public function show($id)
    {
        $salida_revision = SalidaRevision::find($id);

        return view('admin/salidarevision/show')->with('salida_revision', $salida_revision);
    }
    public function edit($id)
    {
        $salida_revision = SalidaRevision::find($id);
        return view('admin/salidarevision/edit')->with('salida_revision', $salida_revision);
    }
    public function update(Request $request, $id)
    {
        // Validación de datos
        $request->validate([
            'fecha_salida' => 'required|date',
            // Agrega aquí otras reglas según tu formulario
        ]);
        $salidarevision = SalidaRevision::findOrFail($id);
        $salidarevision->fecha_salida = $request->fecha_salida;
        $salidarevision->descripcion = $request->descripcion;
        $salidarevision->fecha_retorno = $request->fecha_retorno;
        $salidarevision->observaciones = $request->observaciones;

        $inventario = Inventario::find($salidarevision->id_inventario);

        if ($request->fecha_retorno) {
            $salidarevision->estado = 0; // Inactivo
            if ($inventario) {
                $inventario->estado = 1; // Disponible
                $inventario->save();
            }
        } else {
            $salidarevision->estado = 1; // Activo
            if ($inventario) {
                $inventario->estado = 3; // No disponible
                $inventario->save();
            }
        }

        $salidarevision->save();
        return redirect()->route('salida_revision.index')->with('success', '¡Editado Satisfactoriamente!');
    }
    public function destroy($id)
    {
        $salidarevision = SalidaRevision::findOrFail($id);

        // No permitir eliminar si no existe fecha de retorno
        if (empty($salidarevision->fecha_retorno)) {
            return redirect()->route('salida_revision.index')
                ->with('error', 'No se puede eliminar la salida porque el equipo no ha retornado.');
        }

        $inventario = Inventario::find($salidarevision->id_inventario);

        if ($salidarevision->estado == 1) {
            $salidarevision->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
            if ($inventario) {
                $inventario->estado = 1; // Disponible
                $inventario->save();
            }
        } else {
            $salidarevision->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
            if ($inventario) {
                $inventario->estado = 3; // No disponible
                $inventario->save();
            }
        }
        $salidarevision->save();
        return redirect()->route('salida_revision.index')->with('success', $mensaje);
    }
}

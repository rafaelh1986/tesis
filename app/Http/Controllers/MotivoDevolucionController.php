<?php

namespace App\Http\Controllers;

use App\Models\MotivoDevolucion;
use Illuminate\Http\Request;

class MotivoDevolucionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:motivo_devolucion.index'])->only('index');
        $this->middleware(['permission:motivo_devolucion.create'])->only('create');
        $this->middleware(['permission:motivo_devolucion.store'])->only('store');
        $this->middleware(['permission:motivo_devolucion.edit'])->only('edit');
        $this->middleware(['permission:motivo_devolucion.update'])->only('update');
        $this->middleware(['permission:motivo_devolucion.destroy'])->only('destroy');
        $this->middleware(['permission:motivo_devolucion.show'])->only('show');
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $motivo_devoluciones = MotivoDevolucion::paginate($perPage);
        return view('admin/motivo_devolucion/index', compact('motivo_devoluciones', 'perPage'));
    }

    public function create()
    {
        return view('admin/motivo_devolucion/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:motivo_devolucion,nombre',
            'descripcion' => 'nullable|string',
        ]);
        
        $motivo = new MotivoDevolucion();
        $motivo->nombre = $request->nombre;
        $motivo->descripcion = $request->descripcion;
        $motivo->save();
        
        return redirect()->route('motivo_devolucion.index')->with('success', '¡Creado Satisfactoriamente!');
    }

    public function show($id)
    {
        $motivo_devolucion = MotivoDevolucion::find($id);
        if (!$motivo_devolucion) {
            return redirect()->route('motivo_devolucion.index')->with('error', 'Motivo de devolución no encontrado.');
        }
        return view('admin/motivo_devolucion/show')->with('motivo_devolucion', $motivo_devolucion);
    }

    public function edit($id)
    {
        $motivo_devolucion = MotivoDevolucion::find($id);
        if (!$motivo_devolucion) {
            return redirect()->route('motivo_devolucion.index')->with('error', 'Motivo de devolución no encontrado.');
        }
        return view('admin/motivo_devolucion/edit')->with('motivo_devolucion', $motivo_devolucion);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:motivo_devolucion,nombre,' . $id,
            'descripcion' => 'nullable|string',
        ]);
        
        $motivo_devolucion = MotivoDevolucion::find($id);
        $motivo_devolucion->nombre = $request->nombre;
        $motivo_devolucion->descripcion = $request->descripcion;
        $motivo_devolucion->save();
        
        return redirect()->route('motivo_devolucion.index')->with('success', '¡Editado Satisfactoriamente!');
    }

    public function destroy($id)
    {
        $motivo_devolucion = MotivoDevolucion::find($id);
        if ($motivo_devolucion->estado == 1) {
            $motivo_devolucion->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        } else {
            $motivo_devolucion->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $motivo_devolucion->save();
        return redirect()->route('motivo_devolucion.index')->with('success', $mensaje);
    }
}
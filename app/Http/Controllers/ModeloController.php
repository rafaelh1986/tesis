<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Models\TipoEquipo;

use Illuminate\Http\Request;

class ModeloController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware(['permission:modelo.index'])->only('index');
        $this->middleware(['permission:modelo.create'])->only('create');
        $this->middleware(['permission:modelo.store'])->only('store');
        $this->middleware(['permission:modelo.edit'])->only('edit');
        $this->middleware(['permission:modelo.update'])->only('update');
        $this->middleware(['permission:modelo.destroy'])->only('destroy');
        $this->middleware(['permission:modelo.show'])->only('show');
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $modelos = Modelo::paginate($perPage);
        return view('admin/modelo/index', compact('modelos', 'perPage'));
    }
    public function create()
    {
        $tipo_equipos = TipoEquipo::where('estado', 1)->get();
        return view('admin/modelo/create')->with('tipo_equipos', $tipo_equipos);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_tipo_equipo' => 'required|exists:tipo_equipo,id',
            'nombre_comercial' => 'required|string|max:255|unique:modelo,nombre_comercial',
            'nombre_tecnico' => 'required|string|max:255',
        ]);
        $modelo = new Modelo();
        $modelo->id_tipo_equipo = $request->id_tipo_equipo;
        $modelo->nombre_comercial = $request->nombre_comercial;
        $modelo->nombre_tecnico = $request->nombre_tecnico;
        $modelo->save();
        return redirect()->route('modelo.index')->with('success', '¡Creado Satisfactoriamente!');
    }
    public function show($id)
    {
        $modelo = Modelo::find($id);
        if (!$modelo) {
            return redirect()->route('modelo.index')->with('error', 'Modelo no encontrado.');
        }
        return view('admin/modelo/show')->with('modelo', $modelo);
    }
    public function edit($id)
    {
        $modelo = Modelo::find($id);
        $tipo_equipos = TipoEquipo::where('estado', 1)->get();
        if (!$modelo) {
            return redirect()->route('modelo.index')->with('error', 'Modelo no encontrado.');
        }
        return view('admin/modelo/edit', compact('modelo', 'tipo_equipos'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_tipo_equipo' => 'required|exists:tipo_equipo,id',
            'nombre_comercial' => 'required|string|max:255|unique:modelo,nombre_comercial,' . $id,
            'nombre_tecnico' => 'required|string|max:255',
        ]);
        $modelo = Modelo::find($id);
        $modelo->id_tipo_equipo = $request->id_tipo_equipo;
        $modelo->nombre_comercial = $request->nombre_comercial;
        $modelo->nombre_tecnico = $request->nombre_tecnico;
        $modelo->save();
        return redirect()->route('modelo.index')->with('success', '¡Editado Satisfactoriamente!');
    }
    public function destroy($id)
    {
        $modelo = Modelo::find($id);
        if (!$modelo) {
            return redirect()->route('modelo.index')->with('error', 'Modelo no encontrado.');
        }
        if ($modelo->estado == 1) {
            $modelo->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        } else {
            $modelo->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $modelo->save();
        return redirect()->route('modelo.index')->with('success', $mensaje);
    }
}

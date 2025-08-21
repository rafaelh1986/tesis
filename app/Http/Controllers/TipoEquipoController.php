<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoEquipo;

class TipoEquipoController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware(['permission:tipo_equipo.index'])->only('index');
        $this->middleware(['permission:tipo_equipo.create'])->only('create');
        $this->middleware(['permission:tipo_equipo.store'])->only('store');
        $this->middleware(['permission:tipo_equipo.edit'])->only('edit');
        $this->middleware(['permission:tipo_equipo.update'])->only('update');
        $this->middleware(['permission:tipo_equipo.destroy'])->only('destroy');
        $this->middleware(['permission:tipo_equipo.show'])->only('show');
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $tipo_equipos = TipoEquipo::paginate($perPage);
        return view('admin/tipo_equipo/index', compact('tipo_equipos', 'perPage'));
    }
    public function create()
    {

        return view('admin/tipo_equipo/create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:tipo_equipo,nombre',
        ]);
        $tipo_equipo = new TipoEquipo();
        $tipo_equipo->nombre = $request->nombre;
        //dd($ciudad);
        $tipo_equipo->save();
        return redirect()->route('tipo_equipo.index')->with('success', '¡Creado Satisfactoriamente!');
    }
    public function show($id)
    {
        $tipo_equipo = TipoEquipo::find($id);
        if (!$tipo_equipo) {
        return redirect()->route('tipo_equipo.index')->with('error', 'Tipo de equipo no encontrado.');
    }
        return view('admin/tipo_equipo/show')->with('tipo_equipo', $tipo_equipo);
    }
    public function edit($id)
    {
        $tipo_equipo = TipoEquipo::find($id);
        if (!$tipo_equipo) {
        return redirect()->route('tipo_equipo.index')->with('error', 'Tipo de equipo no encontrado.');
    }
        return view('admin/tipo_equipo/edit')->with('tipo_equipo', $tipo_equipo);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
        'nombre' => 'required|string|max:255|unique:tipo_equipo,nombre,'.$id,
    ]);
        $tipo_equipo = TipoEquipo::find($id);
        if (!$tipo_equipo) {
            return redirect()->route('tipo_equipo.index')->with('error', 'Tipo de equipo no encontrado.');
        }
        $tipo_equipo->nombre = $request->nombre;
        $tipo_equipo->save();
        return redirect()->route('tipo_equipo.index')->with('success', '¡Editado Satisfactoriamente!');
    }
    public function destroy($id)
    {
        $tipo_equipo = TipoEquipo::find($id);
        if ($tipo_equipo->estado == 1) {
            $tipo_equipo->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        } else {
            $tipo_equipo->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $tipo_equipo->save();
        return redirect()->route('tipo_equipo.index')->with('success', $mensaje);
    }
}

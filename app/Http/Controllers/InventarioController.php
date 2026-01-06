<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Inventario;
use App\Models\Equipo;
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
{
    //
    public function __construct()
    {

        $this->middleware(['permission:inventario.index'])->only('index');
        $this->middleware(['permission:inventario.create'])->only('create');
        $this->middleware(['permission:inventario.store'])->only('store');
        $this->middleware(['permission:inventario.edit'])->only('edit');
        $this->middleware(['permission:inventario.update'])->only('update');
        $this->middleware(['permission:inventario.destroy'])->only('destroy');
        $this->middleware(['permission:inventario.show'])->only('show');
    }

    public function index(Request $request)
{
    $perPage = $request->input('per_page', 10); // Valor por defecto: 10
    $inventarios = Inventario::paginate($perPage);
    return view('admin/inventario/index', compact('inventarios', 'perPage'));
}
    public function create()
    {
        // Solo equipos activos
        $equipos = Equipo::where('estado', 1)->with('modelo')->get();

        // Calcula la cantidad de inventarios registrados por equipo
        $inventariosPorEquipo = Inventario::select('id_equipo', DB::raw('count(*) as usados'))
            ->groupBy('id_equipo')
            ->pluck('usados', 'id_equipo');

        return view('admin/inventario/create', compact('equipos', 'inventariosPorEquipo'));
    }

    public function store(Request $request)
    {
        $request->merge(['numero_serie' => strtoupper($request->input('numero_serie'))]);
        $request->validate([
            'id_equipo' => 'required|exists:equipo,id',
            'numero_serie' => 'required|string|max:255|unique:inventario,numero_serie',
            'codigo_activo_fijo' => 'nullable|string|max:255|unique:inventario,codigo_activo_fijo',
        ]);
        $inventario = new Inventario();
        $inventario->id_equipo = $request->id_equipo;
        $inventario->numero_serie = $request->numero_serie;
        $inventario->codigo_activo_fijo = $request->codigo_activo_fijo;
        $inventario->save();
        return redirect()->route('inventario.index')->with('success', 'Creado Satisfactoriamente!');
    }
    public function show($id)
    {
        $inventario = Inventario::find($id);
        if (!$inventario) {
            return redirect()->route('inventario.index')->with('error', 'Inventario no encontrado.');
        }
        return view('admin/inventario/show')->with('inventario', $inventario);
    }
    public function edit($id)
    {
        $inventario = Inventario::find($id);
        if (!$inventario) {
            return redirect()->route('inventario.index')->with('error', 'Inventario no encontrado.');
        }
        return view('admin/inventario/edit')->with('inventario', $inventario);
    }
    public function update(Request $request, $id)
    {
        $request->merge(['numero_serie' => strtoupper($request->input('numero_serie'))]);

        $request->validate([
            'id_equipo' => 'required|exists:equipo,id',
            'numero_serie' => 'required|string|max:255|unique:inventario,numero_serie,' . $id . ',id',
            'codigo_activo_fijo' => 'nullable|string|max:255|unique:inventario,codigo_activo_fijo,' . $id . ',id',
        ]);
        $inventario = Inventario::find($id);
        //dd($inventario);
        if (!$inventario) {
            return redirect()->route('inventario.index')->with('error', 'Inventario no encontrado.');
        }
        $inventario->id_equipo = $request->id_equipo;
        $inventario->numero_serie = $request->numero_serie;
        $inventario->codigo_activo_fijo = $request->codigo_activo_fijo;
        $inventario->save();
        return redirect()->route('inventario.index')->with('success', 'Editado Satisfactoriamente!');
    }
    public function destroy($id)
    {
        $inventario = Inventario::find($id);
        if (!$inventario) {
            return redirect()->route('inventario.index')->with('error', 'Inventario no encontrado.');
        }
        if ($inventario->estado == 1) {
            $inventario->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        } else {
            $inventario->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $inventario->save();
        return redirect()->route('inventario.index')->with('success', $mensaje);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Equipo;
use App\Models\Modelo;
use App\Models\Marca;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;

class EquipoController extends Controller
{
    //
    public function __construct()
    {

        $this->middleware(['permission:equipo.index'])->only('index');
        $this->middleware(['permission:equipo.create'])->only('create');
        $this->middleware(['permission:equipo.store'])->only('store');
        $this->middleware(['permission:equipo.edit'])->only('edit');
        $this->middleware(['permission:equipo.update'])->only('update');
        $this->middleware(['permission:equipo.destroy'])->only('destroy');
        $this->middleware(['permission:equipo.show'])->only('show');
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $equipos = Equipo::paginate($perPage);
        return view('admin/equipo/index', compact('equipos', 'perPage'));
    }
    public function create()
    {

        $modelos = Modelo::where('estado', 1)->get();
        $marcas = Marca::where('estado', 1)->get();
        $proveedores = Proveedor::where('estado', 1)->get();
        return view('admin/equipo/create')->with('modelos', $modelos)
            ->with('marcas', $marcas)->with('proveedores', $proveedores);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_modelo' => 'required|exists:modelo,id',
            'id_marca' => 'required|exists:marca,id',
            'id_proveedor' => 'required|exists:proveedor,id',
            'garantia' => 'nullable|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'fecha_recepcion' => 'required|date',
            'orden_compra' => 'nullable|string|max:255',
        ]);
        $equipo = new Equipo();
        $equipo->id_modelo = $request->id_modelo;
        $equipo->id_marca = $request->id_marca;
        $equipo->id_proveedor = $request->id_proveedor;
        $equipo->garantia = $request->garantia;
        $equipo->cantidad = $request->cantidad;
        $equipo->fecha_recepcion = $request->fecha_recepcion;
        $equipo->orden_compra = $request->orden_compra;

        $equipo->save();
        return redirect()->route('equipo.index')->with('success', '¡Creado Satisfactoriamente!');
    }
    public function show($id)
    {
        $equipo = Equipo::find($id);
        if (!$equipo) {
            return redirect()->route('equipo.index')->with('error', 'Equipo no encontrado.');
        }
        // Usar relaciones Eloquent definidas en el modelo Equipo
        return view('admin/equipo/show')
            ->with('equipo', $equipo)
            ->with('modelo', $equipo->modelo)
            ->with('marca', $equipo->marca)
            ->with('proveedor', $equipo->proveedor);
    }
    public function edit($id)
    {
        $equipo = Equipo::find($id);
        if (!$equipo) {
            return redirect()->route('equipo.index')->with('error', 'Equipo no encontrado.');
        }
        $modelos = Modelo::where('estado', 1)->get();
        $marcas = Marca::where('estado', 1)->get();
        $proveedores = Proveedor::where('estado', 1)->get();
        return view('admin/equipo/edit')
            ->with('equipo', $equipo)
            ->with('modelos', $modelos)
            ->with('marcas', $marcas)
            ->with('proveedores', $proveedores);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_modelo' => 'required|exists:modelo,id',
            'id_marca' => 'required|exists:marca,id',
            'id_proveedor' => 'required|exists:proveedor,id',
            'garantia' => 'nullable|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'fecha_recepcion' => 'required|date',
            'orden_compra' => 'nullable|string|max:255',
        ]);
        $equipo = Equipo::find($id);
        if (!$equipo) {
            return redirect()->route('equipo.index')->with('error', 'Equipo no encontrado.');
        }

        
        $equipo->id_modelo = $request->id_modelo;
        $equipo->id_marca = $request->id_marca;
        $equipo->id_proveedor = $request->id_proveedor;
        $equipo->garantia = $request->garantia;
        $equipo->cantidad = $request->cantidad;
        $equipo->fecha_recepcion = $request->fecha_recepcion;
        $equipo->orden_compra = $request->orden_compra;
        $equipo->save();
        return redirect()->route('equipo.index')->with('success', '¡Editado Satisfactoriamente!');
    }
    public function destroy($id)
    {
        $equipo = Equipo::find($id);
        if (!$equipo) {
            return redirect()->route('equipo.index')->with('error', 'Equipo no encontrado.');
        }
        if ($equipo->estado == 1) {
            $equipo->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        } else {
            $equipo->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $equipo->save();
        return redirect()->route('equipo.index')->with('success', $mensaje);
    }
    public function grafico()
    {
        $coleccion = DB::select(
            "SELECT teq.nombre AS 'Tipo de equipo', mo.nombre_comercial AS Modelo, SUM(eq.cantidad) AS Cantidad
            FROM equipo eq, tipo_equipo teq, modelo mo
            WHERE mo.id_tipo_equipo=teq.id AND eq.id_modelo=mo.id AND mo.id_tipo_equipo=1
            GROUP BY teq.nombre, mo.nombre_comercial
            ORDER BY Cantidad DESC;"
        );
        $datos = [];
        foreach ($coleccion as $fila) {
            $item = [$fila->Modelo . ' (' . $fila->Cantidad . ')', (int)$fila->Cantidad];
            array_push($datos, $item);
        }
        return view('admin/equipo/grafico')->with('datos', $datos);
    }
    public function graficoPorAnio(Request $request)
    {
        // Si hay filtro de año, úsalo; si no, muestra todos los años
        $anio = $request->input('anio');
        $query = DB::table('equipo')
            ->select(DB::raw('YEAR(fecha_recepcion) as anio'), DB::raw('SUM(cantidad) as cantidad'))
            ->groupBy(DB::raw('YEAR(fecha_recepcion)'))
            ->orderBy('anio', 'desc');

        $anios = DB::table('equipo')
            ->select(DB::raw('YEAR(fecha_recepcion) as anio'))
            ->distinct()
            ->orderBy('anio', 'desc')
            ->pluck('anio');

        if ($anio) {
            $query->having('anio', '=', $anio);
        }

        $coleccion = $query->get();

        $colores = ['#3366cc', '#dc3912', '#ff9900', '#109618', '#990099', '#0099c6', '#dd4477', '#66aa00', '#b82e2e', '#316395'];
        $datos = [];
        $colorIndex = 0;
        foreach ($coleccion as $fila) {
            $color = $colores[$colorIndex % count($colores)];
            $item = [strval($fila->anio), (int)$fila->cantidad, $color];
            array_push($datos, $item);
            $colorIndex++;
        }

        return view('admin/equipo/grafico_anio', [
            'datos' => $datos,
            'anios' => $anios,
            'anioSeleccionado' => $anio
        ]);
    }
}

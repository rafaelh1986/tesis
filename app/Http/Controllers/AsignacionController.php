<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Asignacion;
use App\Models\Empleado;
use App\Models\DetalleAsignacion;
use App\Models\Inventario;
use App\Models\TipoEquipo;
use App\Models\Equipo;

use Barryvdh\DomPDF\Facade\Pdf;

class AsignacionController extends Controller
{
    //
    public function __construct()
    {

        $this->middleware(['permission:asignacion.index'])->only('index');
        $this->middleware(['permission:asignacion.create'])->only('create');
        $this->middleware(['permission:asignacion.store'])->only('store');
        $this->middleware(['permission:asignacion.edit'])->only('edit');
        $this->middleware(['permission:asignacion.update'])->only('update');
        $this->middleware(['permission:asignacion.destroy'])->only('destroy');
        $this->middleware(['permission:asignacion.show'])->only('show');
    }

    public function index(Request $request)
    {
        //dd($request);
        $asignaciones = Asignacion::paginate(10);
        return view('admin/asignacion/index')->with('asignaciones', $asignaciones);
    }
    public function create()
    {
        $empleados = Empleado::where('estado', 1)->get();

        return view('admin/asignacion/create')->with('empleados', $empleados);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_empleado' => 'required|exists:empleados,id',
            'fecha_asignacion' => 'required|date',
        ]);
        $asignacion = new Asignacion();
        $asignacion->id_empleado = $request->id_empleado;
        $asignacion->fecha_asignacion = $request->fecha_asignacion;
        $asignacion->estado = 0;

        $asignacion->save();
        return redirect()->route('asignacion.edit', $asignacion->id)->with('success', '¡Creado Satisfactoriamente!');
    }
    public function storeDetalle(Request $request)
    {
        $request->validate([
            'id_inventario' => 'required|exists:inventario,id',
            'id_asignacion' => 'required|exists:asignacion,id',
        ]);
        $detalle = new DetalleAsignacion();
        $id_inventario = $request->id_inventario;
        $id_asignacion = $request->id_asignacion;
        if ($this->verificarItemExistenteEnAsignacion($id_inventario, $id_asignacion) == false) {
            $detalle->id_inventario = $request->id_inventario;
            $detalle->id_asignacion = $request->id_asignacion;
            $detalle->estado = 1;
            $detalle->save();

            $inventario = Inventario::find($request->id_inventario);
            if ($inventario) {
                $inventario->estado = 2;
                $inventario->save();
            }
        }
        return redirect()->route('asignacion.edit', $request->id_asignacion);
    }

    public function verificarItemExistenteEnAsignacion($id_inventario, $id_asignacion)
    {
        return DetalleAsignacion::where('id_asignacion', $id_asignacion)
            ->where('id_inventario', $id_inventario)
            ->where('estado', 1) // o el estado que uses para asignado
            ->exists();
    }

    public function show($id)
    {
        $asignacion = Asignacion::find($id);
        if (!$asignacion) {
            return redirect()->route('asignacion.index')->with('error', 'Asignación no encontrada.');
        }

        return view('admin/asignacion/show')->with('asignacion', $asignacion);
    }
    public function edit($id)
    {
        $asignacion = Asignacion::find($id);
        if (!$asignacion) {
            return redirect()->route('asignacion.index')->with('error', 'Asignación no encontrada.');
        }
        $inventarios = Inventario::where('estado', 1)->get();
        $detalleAsignaciones = DetalleAsignacion::where('id_asignacion', $id)->where('estado', 1)->get();
        return view('admin/asignacion/edit')->with('asignacion', $asignacion)
            ->with('inventarios', $inventarios)->with('detalleAsignaciones', $detalleAsignaciones);
    }
    public function update(Request $request, $id)
    {
        //dd($request);
        $asignacion = Asignacion::find($id);
        if (!$asignacion) {
            return redirect()->route('asignacion.index')->with('error', 'Asignación no encontrada.');
        }
        $asignacion->estado = 1;
        $asignacion->save();

        return redirect()->route('asignacion.index')->with('success', '¡Editado Satisfactoriamente!');
    }


    public function destroy($id)
    {
        $asignacion = Asignacion::find($id);
        if (!$asignacion) {
            return redirect()->route('asignacion.index')->with('error', 'Asignación no encontrada.');
        }

        // Cambiar estado de los detalles y de los inventarios asociados
        foreach ($asignacion->detalleAsignaciones as $detalle) {
            if ($detalle->estado == 1) { // Solo si está asignado
                $detalle->estado = 0;
                $detalle->save();

                $inventario = Inventario::find($detalle->id_inventario);
                if ($inventario) {
                    $inventario->estado = 1; // disponible
                    $inventario->save();
                }
            }
        }
        // Cambiar estado de la asignación a eliminado
        $asignacion->estado = 0;
        $asignacion->save();

        return redirect()->route('asignacion.index');
    }

    public function destroyDetalle($id)
    {
        $detalle = DetalleAsignacion::find($id);
        // Cambiar estado del inventario a disponible (por ejemplo, 1)
        if ($detalle && $detalle->estado == 1) { // Solo si está asignado
            $detalle->estado = 0;
            $detalle->save();

            $inventario = Inventario::find($detalle->id_inventario);
            if ($inventario) {
                $inventario->estado = 1; // disponible
                $inventario->save();
            }
        }
        return redirect()->route('asignacion.edit', $detalle->id_asignacion);
    }
    public function cancelar($id)
    {
        $asignacion = Asignacion::find($id);
        if (!$asignacion) {
            return redirect()->route('asignacion.index')->with('error', 'Asignación no encontrada.');
        }

        foreach ($asignacion->detalleAsignaciones as $detalle) {
            if ($detalle->estado == 1) { // Solo si está asignado
                $detalle->estado = 0;
                $detalle->save();

                $inventario = Inventario::find($detalle->id_inventario);
                if ($inventario) {
                    $inventario->estado = 1; // disponible
                    $inventario->save();
                }
            }
        }

        $asignacion->estado = 0;
        $asignacion->save();

        return redirect()->route('asignacion.index');
    }

    public function notaAsignacion($id)
    {

        $asignacion = Asignacion::find($id);
        $detalleAsignaciones = DetalleAsignacion::where('id_asignacion', $id)->where('estado', 1)->get();
        //dd($detalleAsignaciones);
        $pdf = Pdf::loadView('admin.asignacion.nota_asignacion', compact('asignacion', 'detalleAsignaciones'));
        return $pdf->download('notaAsignacion.pdf');
        //return view ('admin.asignacion.nota_asignacion',compact('asignacion','detalleAsignaciones'));
    }

    public function notaAsignacionPDF($id)
    {

        $asignacion = Asignacion::find($id);
        if (!$asignacion) {
            return redirect()->route('asignacion.index')->with('error', 'Asignación no encontrada.');
        }
        $detalleAsignaciones = DetalleAsignacion::where('id_asignacion', $id)->where('estado', 1)->get();
        $pdf = Pdf::loadView('admin.asignacion.nota_asignacion', compact('asignacion', 'detalleAsignaciones'));
        return $pdf->download('notaAsignacion.pdf');
        //return view ('admin.asignacion.nota_asignacion',compact('asignacion','detalleAsignaciones'));
    }
    public function listadoAsignaciones(Request $request)
    {
        // Para los selects del filtro
        $empleados = Empleado::with('persona')->where('estado', 1)->get();
        $tipos_equipo = TipoEquipo::all();
        $equipos = Equipo::with('modelo')->get();

        $query = DetalleAsignacion::with([
            'asignacion.empleado.persona',
            'inventario.equipo.modelo.tipo_equipo'
        ])->where('detalle_asignacion.estado', 1);

        if ($request->filled('empleado_id')) {
            $query->whereHas('asignacion', function ($q) use ($request) {
                $q->where('id_empleado', $request->empleado_id);
            });
        }
        if ($request->filled('tipo_equipo_id')) {
            $query->whereHas('inventario.equipo.modelo', function ($q) use ($request) {
                $q->where('id_tipo_equipo', $request->tipo_equipo_id);
            });
        }
        if ($request->filled('equipo_id')) {
            $query->whereHas('inventario.equipo', function ($q) use ($request) {
                $q->where('id', $request->equipo_id);
            });
        }
        if ($request->filled('fecha_recepcion')) {
            $query->whereHas('inventario.equipo', function ($q) use ($request) {
                $q->whereDate('fecha_recepcion', $request->fecha_recepcion);
            });
        }
        // Ordenar por nombre del empleado (persona)
        $query->join('asignacion', 'detalle_asignacion.id_asignacion', '=', 'asignacion.id')
            ->join('empleado', 'asignacion.id_empleado', '=', 'empleado.id')
            ->join('persona', 'empleado.id_persona', '=', 'persona.id')
            ->orderBy('persona.nombres')
            ->select('detalle_asignacion.*');

        $detalles = $query->get();

        return view('admin.asignacion.listado_asignaciones', compact('detalles', 'empleados', 'tipos_equipo', 'equipos'));
    }
}

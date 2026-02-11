<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Devolucion;
use App\Models\DetalleAsignacion;
use App\Models\Inventario;
use App\Models\MotivoDevolucion;
use Illuminate\Support\Facades\Auth;

class DevolucionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:devolucion.index'])->only('index');
        $this->middleware(['permission:devolucion.create'])->only('create');
        $this->middleware(['permission:devolucion.store'])->only('store');
        $this->middleware(['permission:devolucion.edit'])->only('edit');
        $this->middleware(['permission:devolucion.update'])->only('update');
        $this->middleware(['permission:devolucion.destroy'])->only('destroy');
        $this->middleware(['permission:devolucion.show'])->only('show');
    }

    public function index(Request $request)
    {

        $perPage = (int) $request->input('per_page', 10);
        $perPage = $perPage > 0 && $perPage <= 100 ? $perPage : 10;

        $devoluciones = Devolucion::with([
            'detalleAsignacion.asignacion',
            'detalleAsignacion.inventario',
            'motivo'
        ])
            ->latest('fecha_devolucion')
            ->paginate($perPage);
        return view('admin/devolucion/index', compact('devoluciones', 'perPage'));
    }

    public function create()
    {

        // Mostrar solo asignaciones ACTIVAS (sin devolución activa)
        $detalles_asignacion = DetalleAsignacion::activas()
            ->with(['asignacion', 'inventario'])
            ->get();

        $motivo_devolucion = MotivoDevolucion::where('estado', 1)->get();

        return view('admin/devolucion/create', compact('detalles_asignacion', 'motivo_devolucion'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_detalle_asignacion' => 'required|exists:detalle_asignacion,id',
            'id_motivo_devolucion' => 'required|exists:motivo_devolucion,id',
            'fecha_devolucion' => 'required|date',
            'observaciones' => 'nullable|string',
        ]);
        // 🔒 Evitar doble devolución activa
        $yaDevuelta = Devolucion::where('id_detalle_asignacion', $request->id_detalle_asignacion)
            ->where('estado', 1)
            ->exists();

        if ($yaDevuelta) {
            return back()
                ->withErrors(['id_detalle_asignacion' => 'Esta asignación ya tiene una devolución activa.'])
                ->withInput();
        }

        $devolucion = new Devolucion();
        $devolucion->id_detalle_asignacion  = $request->id_detalle_asignacion;
        $devolucion->id_motivo_devolucion   = $request->id_motivo_devolucion;
        $devolucion->fecha_devolucion       = $request->fecha_devolucion;
        $devolucion->observaciones          = $request->observaciones;
        $devolucion->estado                 = 1; // activa
        $devolucion->save();

        // Cambiar inventario a disponible
        $detalle = DetalleAsignacion::find($request->id_detalle_asignacion);
        if ($detalle && $detalle->id_inventario) {
            $inventario = Inventario::find($detalle->id_inventario);
            if ($inventario) {
                $inventario->estado = 1; // disponible
                $inventario->save();
            }
        }

        return redirect()
            ->route('devolucion.index')
            ->with('success', '¡Devolución registrada satisfactoriamente!');
    }


    public function show($id)
    {
        $devolucion = Devolucion::with([
            'detalleAsignacion.asignacion',
            'detalleAsignacion.inventario',
            'motivo'
        ])->find($id);

        if (!$devolucion) {
            return redirect()->route('devolucion.index')->with('error', 'Devolución no encontrada.');
        }

        return view('admin/devolucion/show', compact('devolucion'));
    }


    public function edit($id)
    {
        $devolucion = Devolucion::with(['detalleAsignacion.asignacion', 'detalleAsignacion.inventario', 'motivo'])->find($id);
        if (!$devolucion) {
            return redirect()->route('devolucion.index')->with('error', 'Devolución no encontrada.');
        }

        $detalles_asignacion = DetalleAsignacion::activas()
            ->with(['asignacion', 'inventario'])
            ->get();

        $motivo_devolucion = MotivoDevolucion::where('estado', 1)->get();

        return view('admin/devolucion/edit', compact('devolucion', 'detalles_asignacion', 'motivo_devolucion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_detalle_asignacion' => 'required|exists:detalle_asignacion,id',
            'id_motivo_devolucion' => 'required|exists:motivo_devolucion,id',
            'fecha_devolucion' => 'required|date',
            'observaciones' => 'nullable|string',
        ]);

        $devolucion = Devolucion::find($id);
        if (!$devolucion) {
            return redirect()->route('devolucion.index')->with('error', 'Devolución no encontrada.');
        }

        $devolucion->id_detalle_asignacion  = $request->id_detalle_asignacion;
        $devolucion->id_motivo_devolucion   = $request->id_motivo_devolucion;
        $devolucion->fecha_devolucion       = $request->fecha_devolucion;
        $devolucion->observaciones          = $request->observaciones;
        $devolucion->save();

        return redirect()->route('devolucion.index')
            ->with('success', '¡Editado Satisfactoriamente!');
    }

    public function destroy($id)
    {
        $devolucion = Devolucion::find($id);
        if (!$devolucion) {
            return redirect()->route('devolucion.index')->with('error', 'Devolución no encontrada.');
        }

        if ($devolucion->estado == 1) {
            $devolucion->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        } else {
            $devolucion->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $devolucion->save();

        return redirect()->route('devolucion.index')->with('success', $mensaje);
    }
}

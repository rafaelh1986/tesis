<?php

namespace App\Http\Controllers;

use App\Models\MotivoBaja;

use Illuminate\Http\Request;

class MotivoBajaController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware(['permission:motivo_baja.index'])->only('index');
        $this->middleware(['permission:motivo_baja.create'])->only('create');
        $this->middleware(['permission:motivo_baja.store'])->only('store');
        $this->middleware(['permission:motivo_baja.edit'])->only('edit');
        $this->middleware(['permission:motivo_baja.update'])->only('update');
        $this->middleware(['permission:motivo_baja.destroy'])->only('destroy');
        $this->middleware(['permission:motivo_baja.show'])->only('show');
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $motivo_bajas = MotivoBaja::paginate($perPage);
        return view('admin/motivo_baja/index',compact('motivo_bajas', 'perPage'));
    }
    public function create()
    {

        return view('admin/motivo_baja/create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:motivo_baja,nombre',
        ]);
        $motivo_baja = new MotivoBaja();
        $motivo_baja->nombre = $request->nombre;
        $motivo_baja->save();
        return redirect()->route('motivo_baja.index')->with('success', '¡Creado Satisfactoriamente!');
    }
    public function show($id)
    {
        $motivo_baja = MotivoBaja::find($id);
        if (!$motivo_baja) {
            return redirect()->route('motivo_baja.index')->with('error', 'Motivo de baja no encontrado.');
        }
        return view('admin/motivo_baja/show')->with('motivo_baja', $motivo_baja);
    }
    public function edit($id)
    {
        $motivo_baja = MotivoBaja::find($id);
        if (!$motivo_baja) {
            return redirect()->route('motivo_baja.index')->with('error', 'Motivo de baja no encontrado.');
        }
        return view('admin/motivo_baja/edit')->with('motivo_baja', $motivo_baja);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:motivo_baja,nombre,' . $id,
        ]);
        $motivo_baja = MotivoBaja::find($id);
        $motivo_baja->nombre = $request->nombre;
        $motivo_baja->save();
        return redirect()->route('motivo_baja.index')->with('success', '¡Editado Satisfactoriamente!');
    }
    public function destroy($id)
    {
        $motivo_baja = MotivoBaja::find($id);
        if ($motivo_baja->estado == 1) {
            $motivo_baja->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        } else {
            $motivo_baja->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $motivo_baja->save();
        return redirect()->route('motivo_baja.index')->with('success', $mensaje);
    }
}

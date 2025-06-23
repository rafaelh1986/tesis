<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcaController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware(['permission:marca.index'])->only('index');
        $this->middleware(['permission:marca.create'])->only('create');
        $this->middleware(['permission:marca.store'])->only('store');
        $this->middleware(['permission:marca.edit'])->only('edit');
        $this->middleware(['permission:marca.update'])->only('update');
        $this->middleware(['permission:marca.destroy'])->only('destroy');
        $this->middleware(['permission:marca.show'])->only('show');
    }

    public function index(Request $request)
    {
        $marcas = Marca::paginate(5);
        return view('admin/marca/index')->with('marcas', $marcas);
    }
    public function create()
    {

        return view('admin/marca/create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:marca,nombre',
        ]);
        $marca = new Marca();
        $marca->nombre = $request->nombre;
        $marca->save();
        return redirect()->route('marca.index')->with('success', '¡Creado Satisfactoriamente!');
    }
    public function show($id)
    {
        $marca = Marca::find($id);
        if (!$marca) {
            return redirect()->route('marca.index')->with('error', 'Marca no encontrada.');
        }
        return view('admin/marca/show')->with('marca', $marca);
    }
    public function edit($id)
    {
        $marca = Marca::find($id);
        if (!$marca) {
            return redirect()->route('marca.index')->with('error', 'Marca no encontrada.');
        }
        return view('admin/marca/edit')->with('marca', $marca);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:marca,nombre,' . $id,
        ]);
        $marca = Marca::find($id);
        $marca->nombre = $request->nombre;
        $marca->save();
        return redirect()->route('marca.index')->with('success', '¡Editado Satisfactoriamente!');
    }
    public function destroy($id)
    {
        $marca = Marca::find($id);
        if (!$marca) {
            return redirect()->route('marca.index')->with('error', 'Marca no encontrada.');
        }
        if ($marca->estado == 1) {
            $marca->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        } else {
            $marca->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $marca->save();
        return redirect()->route('marca.index')->with('success', $mensaje);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciudad;

class CiudadController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware(['permission:ciudad.index'])->only('index');
        $this->middleware(['permission:ciudad.create'])->only('create');
        $this->middleware(['permission:ciudad.store'])->only('store');
        $this->middleware(['permission:ciudad.edit'])->only('edit');
        $this->middleware(['permission:ciudad.update'])->only('update');
        $this->middleware(['permission:ciudad.destroy'])->only('destroy');
        $this->middleware(['permission:ciudad.show'])->only('show');
    }

    public function index(Request $request){
        $perPage = $request->input('per_page', 10);
        $ciudades =Ciudad::paginate($perPage);
        return view('admin/ciudad/index', compact('ciudades','perPage'));
    }
    public function create(){
        
        return view('admin/ciudad/create');
    }
    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|string|max:255|unique:ciudad,nombre',
        ]);
        $ciudad = new Ciudad();
        $ciudad->nombre = $request->nombre;
        //dd($ciudad);
        $ciudad->save();
        return redirect()->route('ciudad.index')->with('success','¡Creado Satisfactoriamente!');
    }
    public function show($id){
        $ciudad = Ciudad::find($id);
        return view('admin/ciudad/show')->with('ciudad',$ciudad);
    }
    public function edit($id){
        $ciudad = Ciudad::find($id);
        return view('admin/ciudad/edit')->with('ciudad',$ciudad);
    }
    public function update(Request $request,$id){
        $request->validate([
            'nombre' => 'required|string|max:255|unique:ciudad,nombre,' . $id,
        ]);
        // Verificar si la ciudad ya existe
        $ciudad = Ciudad::find($id);
        if (!$ciudad) {
            return redirect()->route('ciudad.index')->with('error', 'Ciudad no encontrada.');
        }
        $ciudad->nombre = $request->nombre;
        $ciudad->save();
        return redirect()->route('ciudad.index')->with('success','¡Editado Satisfactoriamente!');
    }
    public function destroy($id){
        $ciudad = Ciudad::find($id);
        if (!$ciudad) {
            return redirect()->route('ciudad.index')->with('error', 'Ciudad no encontrada.');
        }
        if($ciudad->estado == 1){
            $ciudad->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        }
        else{
            $ciudad->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $ciudad->save();
        return redirect()->route('ciudad.index')->with('success',$mensaje);
    }
}

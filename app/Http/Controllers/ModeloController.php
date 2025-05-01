<?php

namespace App\Http\Controllers;
use App\Models\Modelo;

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

    public function index(Request $request){
        $modelos =Modelo::paginate(5);
        return view('admin/modelo/index')->with('modelos',$modelos);
    }
    public function create(){
        return view('admin/modelo/create');
    }
    public function store(Request $request){
        //dd($request);
        $modelo = new Modelo();
        $modelo->nombre_comercial = $request->nombre_comercial;
        $modelo->nombre_tecnico = $request->nombre_tecnico;
        //dd($persona);
        $modelo->save();
        return redirect()->route('modelo.index')->with('success','¡Creado Satisfactoriamente!');
    }
    public function show($id){
        $modelo = Modelo::find($id);
        return view('admin/modelo/show')->with('modelo',$modelo);
    }
    public function edit($id){
        $modelo = Modelo::find($id);
        return view('admin/modelo/edit')->with('modelo',$modelo);
    }
    public function update(Request $request,$id){
        //dd($request);
        $modelo = Modelo::find($id);
        $modelo->nombre_comercial = $request->nombre_comercial;
        $modelo->nombre_tecnico = $request->nombre_tecnico;
        $modelo->save();
        return redirect()->route('modelo.index')->with('success','¡Editado Satisfactoriamente!');
    }
    public function destroy($id){
        $modelo = Modelo::find($id);
        if($modelo->estado == 1){
            $modelo->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        }
        else{
            $modelo->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $modelo->save();
        return redirect()->route('modelo.index')->$mensaje;
    }
}

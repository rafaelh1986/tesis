<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoEquipo;

class TipoEquipoController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware(['permission:tipoequipo.index'])->only('index');
        $this->middleware(['permission:tipoequipo.create'])->only('create');
        $this->middleware(['permission:tipoequipo.store'])->only('store');
        $this->middleware(['permission:tipoequipo.edit'])->only('edit');
        $this->middleware(['permission:tipoequipo.update'])->only('update');
        $this->middleware(['permission:tipoequipo.destroy'])->only('destroy');
        $this->middleware(['permission:tipoequipo.show'])->only('show');
    }

    public function index(Request $request){
        $tipo_equipos =TipoEquipo::paginate(5);
        return view('admin/tipo_equipo/index')->with('tipo_equipos',$tipo_equipos);
    }
    public function create(){
        
        return view('admin/tipo_equipo/create');
    }
    public function store(Request $request){
        //dd($request);
        $tipo_equipo = new TipoEquipo();
        $tipo_equipo->nombre = $request->nombre;
        //dd($ciudad);
        $tipo_equipo->save();
        return redirect()->route('tipo_equipo.index')->with('success','¡Creado Satisfactoriamente!');
    }
    public function show($id){
        $tipo_equipo = TipoEquipo::find($id);
        return view('admin/tipo_equipo/show')->with('tipo_equipo',$tipo_equipo);
    }
    public function edit($id){
        $tipo_equipo = TipoEquipo::find($id);
        return view('admin/tipo_equipo/edit')->with('tipo_equipo',$tipo_equipo);
    }
    public function update(Request $request,$id){
        //dd($request);
        $tipo_equipo = TipoEquipo::find($id);
        $tipo_equipo->nombre = $request->nombre;
        $tipo_equipo->save();
        return redirect()->route('tipo_equipo.index')->with('success','¡Editado Satisfactoriamente!');
    }
    public function destroy($id){
        $tipo_equipo = TipoEquipo::find($id);
        if($tipo_equipo->estado == 1){
            $tipo_equipo->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        }
        else{
            $tipo_equipo->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $tipo_equipo->save();
        return redirect()->route('tipo_equipo.index')->with('success',$mensaje);
    }
}

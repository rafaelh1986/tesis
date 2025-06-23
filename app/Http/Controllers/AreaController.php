<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;


class AreaController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware(['permission:area.index'])->only('index');
        $this->middleware(['permission:area.create'])->only('create');
        $this->middleware(['permission:area.store'])->only('store');
        $this->middleware(['permission:area.edit'])->only('edit');
        $this->middleware(['permission:area.update'])->only('update');
        $this->middleware(['permission:area.destroy'])->only('destroy');
        $this->middleware(['permission:area.show'])->only('show');
    }
    public function index(Request $request){
        $areas =Area::paginate(10);
        return view('admin/area/index')->with('areas',$areas);
    }
    public function create(){
        
        return view('admin/area/create');
    }
    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        $area_nombre = $request->nombre;
        if($this->verficarItemExistente($area_nombre)==false){
            $area = new Area();
            $area->nombre = $request->nombre;
            //dd($ciudad);
            $area->save();
            return redirect()->route('area.index')->with('success','¡Creado Satisfactoriamente!');
        }

        return redirect()->route('area.create')->with('error','¡Ya existe!');
        
    }
    public function verficarItemExistente($area_nombre, $exclude_id = null){
        $query = Area::where('estado',1)->where('nombre', $area_nombre);
        if ($exclude_id) {
            $query->where('id', '!=', $exclude_id);
        }
        return $query->exists();
    }
    public function show($id){
        $area = Area::find($id);
        return view('admin/area/show')->with('area',$area);
    }
    public function edit($id){
        $area = Area::find($id);
        return view('admin/area/edit')->with('area',$area);
    }
    public function update(Request $request,$id){
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        $area = Area::find($id);
        $area->nombre = $request->nombre;

        if($this->verficarItemExistente($area->nombre, $area->id)==false){
            $area->save();
            return redirect()->route('area.index')->with('success','¡Editado Satisfactoriamente!');
        }
        return redirect()->route('area.edit',$id)->with('error','¡Ya existe!');
    }
    public function destroy($id){
        $area = Area::find($id);
        if($area->estado == 1){
            $area->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        }
        else{
            $area->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $area->save();
        return redirect()->route('area.index')->with('success',$mensaje);
    }
}

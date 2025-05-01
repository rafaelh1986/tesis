<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Inventario;
use App\Models\Equipo;

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

    public function index(Request $request){
        //dd($request);
        $inventarios =inventario::paginate(5);
        return view('admin/inventario/index')->with('inventarios',$inventarios);
    }
    public function create(){
        $equipos = Equipo::where('estado',1)->get();
        
        return view('admin/inventario/create')->with('equipos',$equipos);
    }
    public function store(Request $request){
        //dd($request);
        $item = $request->numero_serie;
        if($this->verficarItemExistente($item)==false){
            $inventario = new inventario();
            $inventario->id_equipo = $request->id_equipo;
            $inventario->numero_serie = $request->numero_serie;
            $inventario->codigo_activo_fijo = $request->codigo_activo_fijo;       
            $inventario->save();
            return redirect()->route('inventario.index')->with('success','Creado Satisfactoriamente!');
        }
        return redirect()->route('inventario.create')->with('error','Ya existe!');
    }

    public function verficarItemExistente($item){
        $inventarios = Inventario::where('estado',1)->get();
        foreach($inventarios as $detalle){
            if($detalle->numero_serie == $item){
                return true;
            }
        }
        return false;
    }
    public function show($id){
        $inventario = inventario::find($id);
        
        return view('admin/inventario/show')->with('inventario',$inventario);
    }
    public function edit($id){
        $inventario = inventario::find($id);
    
        return view('admin/inventario/edit')->with('inventario',$inventario);
    }
    public function update(Request $request,$id){
        //dd($request);
        $item = $request->numero_serie;
        $inventario = inventario::find($id);
        
        //$inventario->id_equipo = $request->id_equipo;
        if($this->verficarItemExistente($item)==false){
            $inventario->numero_serie = $request->numero_serie;
            $inventario->codigo_activo_fijo = $request->codigo_activo_fijo;
            $inventario->save();
            return redirect()->route('inventario.index')->with('success','Editado Satisfactoriamente!');
        }
        return redirect()->route('inventario.edit',$id)->with('error','Ya existe!');
    }
    public function destroy($id){
        $inventario = inventario::find($id);
        if($inventario->estado == 1){
            $inventario->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        }
        else{
            $inventario->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $inventario->save();
        return redirect()->route('inventario.index')->with('success',$mensaje);
    }
        
}

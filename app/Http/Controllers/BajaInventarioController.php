<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BajaInventario;
use App\Models\Inventario;
use App\Models\MotivoBaja;

class BajaInventarioController extends Controller
{
    //
    public function __construct()
    {
        
        $this->middleware(['permission:baja_inventario.index'])->only('index');
        $this->middleware(['permission:baja_inventario.create'])->only('create');
        $this->middleware(['permission:baja_inventario.store'])->only('store');
        $this->middleware(['permission:baja_inventario.edit'])->only('edit');
        $this->middleware(['permission:baja_inventario.update'])->only('update');
        $this->middleware(['permission:baja_inventario.destroy'])->only('destroy');
        $this->middleware(['permission:baja_inventario.show'])->only('show');
    }

    public function index(Request $request){
        //dd($request);
        $bajainventarios = BajaInventario::paginate(5);
        return view('admin/baja_inventario/index')->with('bajainventarios',$bajainventarios);
    }
    public function create(){
        $inventarios = Inventario::where('estado',1)->get();
        $motivobajas = MotivoBaja::where('estado',1)->get();
        
        return view('admin/baja_inventario/create')->with('inventarios',$inventarios)->with('motivobajas',$motivobajas);
    }
    public function store(Request $request){
        //dd($request);
        $bajainventario = new BajaInventario();
        $bajainventario->id_inventario = $request->id_inventario;
        $bajainventario->id_motivo_baja = $request->id_motivo_baja;
        $bajainventario->fecha = $request->fecha;
        $bajainventario->gestion = $request->gestion;
        $bajainventario->save();
        // Cambiar el estado del inventario a 0 (baja)
        $inventario = Inventario::find($request->id_inventario);
        if ($inventario) {
            $inventario->estado = 0;
            $inventario->save();
        }
        return redirect()->route('bajainventario.index')->with('success','¡Creado Satisfactoriamente!');
    }
    public function show($id){
        $bajainventario = BajaInventario::find($id);
        
        return view('admin/baja_inventario/show')->with('bajainventario',$bajainventario);
    }
    public function edit($id){
        $bajainventario = BajaInventario::find($id);
        return view('admin/baja_inventario/edit')->with('bajainventario',$bajainventario);
    }
    public function update(Request $request,$id){
        //dd($request);
        $bajainventario = BajaInventario::find($id);
        
        $bajainventario->fecha = $request->fecha;
        $bajainventario->gestion = $request->gestion;

        $bajainventario->save();
        return redirect()->route('bajainventario.index')->with('success','¡Editado Satisfactoriamente!');
    }
    public function destroy($id){
        $bajainventario = BajaInventario::find($id);
        $inventario = Inventario::find($bajainventario->id_inventario);
        if($bajainventario->estado == 1){
            $bajainventario->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
            // Cambiar inventario a disponible
            if ($inventario) {
                $inventario->estado = 1;
                $inventario->save();
            }
        }
        else{
            $bajainventario->estado = 1;
            $mensaje = "Restaurado Satisfactoriamente!";
            // Cambiar inventario a baja
            if ($inventario) {
                $inventario->estado = 0;
                $inventario->save();
            }
        }
        $bajainventario->save();
        return redirect()->route('bajainventario.index')->with('success',$mensaje);
    }
        
}

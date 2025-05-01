<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SalidaRevision;
use App\Models\Inventario;
use App\Models\Proveedor;

class SalidaRevisionController extends Controller
{
    //
    public function __construct()
    {
        /*
        $this->middleware(['permission:salidarevision.index'])->only('index');
        $this->middleware(['permission:salidarevision.create'])->only('create');
        $this->middleware(['permission:salidarevision.store'])->only('store');
        $this->middleware(['permission:salidarevision.edit'])->only('edit');
        $this->middleware(['permission:salidarevision.update'])->only('update');
        $this->middleware(['permission:salidarevision.destroy'])->only('destroy');
        $this->middleware(['permission:salidarevision.show'])->only('show');*/
    }

    public function index(Request $request){
        //dd($request);
        $salidarevisiones = SalidaRevision::paginate(5);
        return view('admin/salidarevision/index')->with('salidarevisiones',$salidarevisiones);
    }
    public function create(){
        $inventarios = Inventario::where('estado',1)->get();
        $proveedores = Proveedor::where('estado',1)->get();
        return view('admin/salidarevision/create')->with('proveedores',$proveedores)->with('inventarios',$inventarios);
    }
    public function store(Request $request){
        //dd($request);
        $salidarevision = new SalidaRevision();
        $salidarevision->id_inventario = $request->id_inventario;
        $salidarevision->id_proveedor = $request->id_proveedor;
        $salidarevision->fecha_salida = $request->fecha_salida;
        $salidarevision->descripcion = $request->descripcion;
        $salidarevision->fecha_retorno = $request->fecha_retorno;
        $salidarevision->observaciones = $request->observaciones;
        
        $salidarevision->save();
        return redirect()->route('salida_revision.index')->with('success','¡Creado Satisfactoriamente!');
    }
    public function show($id){
        $salida_revision = SalidaRevision::find($id);
        
        return view('admin/salidarevision/show')->with('salida_revision',$salida_revision);
    }
    public function edit($id){
        $salida_revision = SalidaRevision::find($id);
        return view('admin/salidarevision/edit')->with('salida_revision',$salida_revision);
    }
    public function update(Request $request,$id){
        //dd($request);
        $salidarevision = SalidaRevision::find($id);
        $salidarevision->fecha_salida = $request->fecha_salida;
        $salidarevision->descripcion = $request->descripcion;
        $salidarevision->fecha_retorno = $request->fecha_retorno;
        $salidarevision->observaciones = $request->observaciones;

        $salidarevision->save();
        return redirect()->route('salida_revision.index')->with('success','¡Editado Satisfactoriamente!');
    }
    public function destroy($id){
        $salidarevision = SalidaRevision::find($id);
        if($salidarevision->estado == 1){
            $salidarevision->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        }
        else{
            $salidarevision->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $salidarevision->save();
        return redirect()->route('salida_revision.index')->with('success',$mensaje);
    }
        
}

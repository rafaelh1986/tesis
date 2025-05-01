<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Equipo;
use App\Models\TipoEquipo;
use App\Models\Modelo;
use App\Models\Marca;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;

class EquipoController extends Controller
{
    //
    public function __construct()
    {
        
        $this->middleware(['permission:equipo.index'])->only('index');
        $this->middleware(['permission:equipo.create'])->only('create');
        $this->middleware(['permission:equipo.store'])->only('store');
        $this->middleware(['permission:equipo.edit'])->only('edit');
        $this->middleware(['permission:equipo.update'])->only('update');
        $this->middleware(['permission:equipo.destroy'])->only('destroy');
        $this->middleware(['permission:equipo.show'])->only('show');
    }

    public function index(Request $request){
        //dd($request);
        $equipos = Equipo::paginate(5);
        return view('admin/equipo/index')->with('equipos',$equipos);
    }
    public function create(){
        $tipo_equipos = TipoEquipo::where('estado',1)->get();
        $modelos = Modelo::where('estado',1)->get();
        $marcas = Marca::where('estado',1)->get();
        $proveedores = Proveedor::where('estado',1)->get();
        return view('admin/equipo/create')->with('tipo_equipos',$tipo_equipos)->with('modelos',$modelos)
            ->with('marcas',$marcas)->with('proveedores',$proveedores);
    }
    public function store(Request $request){
        //dd($request);
        $equipo = new Equipo();
        $equipo->id_tipo_equipo = $request->id_tipo_equipo;
        $equipo->id_modelo = $request->id_modelo;
        $equipo->id_marca = $request->id_marca;
        $equipo->id_proveedor = $request->id_proveedor;
        $equipo->garantia = $request->garantia;
        $equipo->cantidad = $request->cantidad;
        $equipo->fecha_recepcion = $request->fecha_recepcion;
        $equipo->orden_compra = $request->orden_compra;
        
        $equipo->save();
        return redirect()->route('equipo.index')->with('success','¡Creado Satisfactoriamente!');
    }
    public function show($id){
        $equipo = Equipo::find($id);
        $tipo_equipo = TipoEquipo::find($id);
        $modelo = Modelo::find($id);
        $marca = Marca::find($id);
        $proveedor = Proveedor::find($id);
        return view('admin/equipo/show')->with('equipo',$equipo)->with('tipo_equipo',$tipo_equipo)->with('modelo',$modelo)
            ->with('marca',$marca)->with('proveedor',$proveedor);
    }
    public function edit($id){
        $equipo = Equipo::find($id);
        //dd($equipo);
        return view('admin/equipo/edit')->with('equipo',$equipo);
    }
    public function update(Request $request,$id){
        //dd($request);
        $equipo =Equipo::find($id);
        
        $equipo->id_tipo_equipo = $request->id_tipo_equipo;
        $equipo->id_modelo = $request->id_modelo;
        $equipo->id_marca = $request->id_marca;
        $equipo->id_proveedor = $request->id_proveedor;
        $equipo->garantia = $request->garantia;     
        $equipo->fecha_recepcion = $request->fecha_recepcion;
        $equipo->orden_compra = $request->orden_compra;
        $equipo->save();
        return redirect()->route('equipo.index')->with('success','¡Editado Satisfactoriamente!');
    }
    public function destroy($id){
        $equipo = Equipo::find($id);
        if($equipo->estado == 1){
            $equipo->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        }
        else{
            $equipo->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $equipo->save();
        return redirect()->route('equipo.index')->with('success',$mensaje);
    }
    public function grafico(){
        $coleccion = DB::select(
            "SELECT mo.nombre_comercial as Modelo, SUM(eq.cantidad) AS Cantidad 
                FROM equipo eq,tipo_equipo te, modelo mo 
                WHERE eq.id_tipo_equipo=te.id AND eq.id_modelo=mo.id AND eq.id_tipo_equipo=2 
                GROUP BY mo.nombre_comercial 
                ORDER BY Cantidad DESC;"
                );
        $datos = [];
        foreach($coleccion as $fila){
            $item = [$fila->Modelo.' ('.$fila->Cantidad.')',$fila->Cantidad];
            array_push($datos,$item);
        }
        return view('admin/equipo/grafico')->with('datos',$datos);
    }
        
}

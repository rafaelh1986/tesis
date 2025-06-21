<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\asignacion;
use App\Models\Empleado;
use App\Models\DetalleAsignacion;
use App\Models\Inventario;

use Barryvdh\DomPDF\Facade\Pdf;

class AsignacionController extends Controller
{
    //
    public function __construct()
    {
        
        $this->middleware(['permission:asignacion.index'])->only('index');
        $this->middleware(['permission:asignacion.create'])->only('create');
        $this->middleware(['permission:asignacion.store'])->only('store');
        $this->middleware(['permission:asignacion.edit'])->only('edit');
        $this->middleware(['permission:asignacion.update'])->only('update');
        $this->middleware(['permission:asignacion.destroy'])->only('destroy');
        $this->middleware(['permission:asignacion.show'])->only('show');
    }

    public function index(Request $request){
        //dd($request);
        $asignaciones =Asignacion::paginate(10);
        return view('admin/asignacion/index')->with('asignaciones',$asignaciones);
    }
    public function create(){
        $empleados = Empleado::where('estado',1)->get();
        
        return view('admin/asignacion/create')->with('empleados',$empleados);
    }
    public function store(Request $request){
        //dd($request);
        $asignacion = new Asignacion();
        $asignacion->id_empleado = $request->id_empleado;
        $asignacion->fecha_asignacion = $request->fecha_asignacion;
        $asignacion->estado = 0;
        
        $asignacion->save();
        return redirect()->route('asignacion.edit',$asignacion->id)->with('success','¡Creado Satisfactoriamente!');
    }
    public function storeDetalle(Request $request){
        //dd($request);
        $detalle = new DetalleAsignacion();
        $id_inventario = $request->id_inventario;
        $id_asignacion = $request->id_asignacion;
        if($this->verificarItemExistenteEnAsignacion($id_inventario, $id_asignacion)==false){
            //dd($id_inventario,$id_asignacion);
            $detalle->id_inventario = $request->id_inventario;
            $detalle->id_asignacion = $request->id_asignacion;
            $detalle->estado = 1;
            $detalle->save();

            $inventario = Inventario::find($request->id_inventario);
            if ($inventario) {
                $inventario->estado = 2;
                $inventario->save();
            }
        }
        
        return redirect()->route('asignacion.edit',$request->id_asignacion);
    }

    public function verificarItemExistenteEnAsignacion($id_inventario, $id_asignacion)
    {
        return DetalleAsignacion::where('id_asignacion', $id_asignacion)
            ->where('id_inventario', $id_inventario)
            ->where('estado', 1) // o el estado que uses para asignado
            ->exists();
    }

    public function show($id){
        $asignacion = Asignacion::find($id);
        
        return view('admin/asignacion/show')->with('asignacion',$asignacion);
    }
    public function edit($id){
        $asignacion = Asignacion::find($id);
        $inventarios = Inventario::where('estado',1)->get();
        $detalleAsignaciones = DetalleAsignacion::where('id_asignacion',$id)->where('estado',1)->get();
        return view('admin/asignacion/edit')->with('asignacion',$asignacion)
            ->with('inventarios',$inventarios)->with('detalleAsignaciones',$detalleAsignaciones);
    }
    public function update(Request $request,$id){
        //dd($request);
        $asignacion = Asignacion::find($id);
        //dd($asignacion);
        $asignacion->estado = 1;
        $asignacion->save();
        //detalle confirmar.
        /*foreach($asignacion->detalleAsignaciones as $detalle){
            if($detalle->estado==2){
                $detalleAsignacion = DetalleAsignacion::find($detalle->id);
                
                $detalleAsignacion->estado =1;
                $detalleAsignacion->save();
                
                $detalleAsignacion->inventario->estado=1;
                $detalleAsignacion->inventario->save();

            }
            

        }*/
        return redirect()->route('asignacion.index')->with('success','¡Editado Satisfactoriamente!');
    }


    public function destroy($id)
    {
        $asignacion = Asignacion::find($id);

        // Cambiar estado de los detalles y de los inventarios asociados
        foreach ($asignacion->detalleAsignaciones as $detalle) {
            if ($detalle->estado == 1) { // Solo si está asignado
                $detalle->estado = 0;
                $detalle->save();

                $inventario = Inventario::find($detalle->id_inventario);
                if ($inventario) {
                    $inventario->estado = 1; // disponible
                    $inventario->save();
                }
            }
        }
        // Cambiar estado de la asignación a eliminado
        $asignacion->estado = 0; 
        $asignacion->save();

        return redirect()->route('asignacion.index');
    }

    public function destroyDetalle($id){
        $detalle = DetalleAsignacion::find($id);
        // Cambiar estado del inventario a disponible (por ejemplo, 1)
        if ($detalle && $detalle->estado == 1) { // Solo si está asignado
            $detalle->estado = 0;
            $detalle->save();

            $inventario = Inventario::find($detalle->id_inventario);
            if ($inventario) {
                $inventario->estado = 1; // disponible
                $inventario->save();
            }
        }
        return redirect()->route('asignacion.edit', $detalle->id_asignacion);
    }
    public function cancelar($id)
    {
        $asignacion = Asignacion::find($id);

        foreach ($asignacion->detalleAsignaciones as $detalle) {
            if ($detalle->estado == 1) { // Solo si está asignado
                $detalle->estado = 0;
                $detalle->save();

                $inventario = Inventario::find($detalle->id_inventario);
                if ($inventario) {
                    $inventario->estado = 1; // disponible
                    $inventario->save();
                }
            }
        }

        $asignacion->estado = 0;
        $asignacion->save();

        return redirect()->route('asignacion.index');
    }
        
    public function notaAsignacion($id){
        
        $asignacion = Asignacion::find($id);
        $detalleAsignaciones = DetalleAsignacion::where('id_asignacion',$id)->where('estado',2)->get();
        //dd($detalleAsignaciones);
        $pdf = Pdf::loadView('admin.asignacion.nota_asignacion',compact('asignacion','detalleAsignaciones'));
        return $pdf->download('notaAsignacion.pdf');
        //return view ('admin.asignacion.nota_asignacion',compact('asignacion','detalleAsignaciones'));
    }

    public function notaAsignacionPDF($id){
        
        $asignacion = Asignacion::find($id);
        $detalleAsignaciones = DetalleAsignacion::where('id_asignacion',$id)->where('estado',2)->get();
        $pdf = Pdf::loadView('admin.asignacion.nota_asignacion',compact('asignacion','detalleAsignaciones'));
        return $pdf->download('notaAsignacion.pdf');
        //return view ('admin.asignacion.nota_asignacion',compact('asignacion','detalleAsignaciones'));
    }
}

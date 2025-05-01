<?php

namespace App\Http\Controllers;
use App\Models\MotivoBaja;

use Illuminate\Http\Request;

class MotivoBajaController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware(['permission:motivobaja.index'])->only('index');
        $this->middleware(['permission:motivobaja.create'])->only('create');
        $this->middleware(['permission:motivobaja.store'])->only('store');
        $this->middleware(['permission:motivobaja.edit'])->only('edit');
        $this->middleware(['permission:motivobaja.update'])->only('update');
        $this->middleware(['permission:motivobaja.destroy'])->only('destroy');
        $this->middleware(['permission:motivobaja.show'])->only('show');
    }

    public function index(Request $request){
        $motivo_bajas =MotivoBaja::paginate(5);
        return view('admin/motivo_baja/index')->with('motivo_bajas',$motivo_bajas);
    }
    public function create(){
        
        return view('admin/motivo_baja/create');
    }
    public function store(Request $request){
        //dd($request);
        $motivo_baja = new MotivoBaja();
        $motivo_baja->nombre = $request->nombre;
        //dd($ciudad);
        $motivo_baja->save();
        return redirect()->route('motivo_baja.index')->with('success','¡Creado Satisfactoriamente!');
    }
    public function show($id){
        $motivo_baja = MotivoBaja::find($id);
        return view('admin/motivo_baja/show')->with('motivo_baja',$motivo_baja);
    }
    public function edit($id){
        $motivo_baja = MotivoBaja::find($id);
        return view('admin/motivo_baja/edit')->with('motivo_baja',$motivo_baja);
    }
    public function update(Request $request,$id){
        //dd($request);
        $motivo_baja = MotivoBaja::find($id);
        $motivo_baja->nombre = $request->nombre;
        $motivo_baja->save();
        return redirect()->route('motivo_baja.index')->with('success','¡Editado Satisfactoriamente!');
    }
    public function destroy($id){
        $motivo_baja = MotivoBaja::find($id);
        if($motivo_baja->estado == 1){
            $motivo_baja->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        }
        else{
            $motivo_baja->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $motivo_baja->save();
        return redirect()->route('motivo_baja.index')->with('success',$mensaje);
    }
}

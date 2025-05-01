<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;

class CargoController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware(['permission:cargo.index'])->only('index');
        $this->middleware(['permission:cargo.create'])->only('create');
        $this->middleware(['permission:cargo.store'])->only('store');
        $this->middleware(['permission:cargo.edit'])->only('edit');
        $this->middleware(['permission:cargo.update'])->only('update');
        $this->middleware(['permission:cargo.destroy'])->only('destroy');
        $this->middleware(['permission:cargo.show'])->only('show');
    }

    public function index(Request $request){
        $cargos =Cargo::paginate(5);
        return view('admin/cargo/index')->with('cargos',$cargos);
    }
    public function create(){
        
        return view('admin/cargo/create');
    }
    public function store(Request $request){
        //dd($request);
        $cargo = new Cargo();
        $cargo->nombre = $request->nombre;
        //dd($cargo);
        $cargo->save();
        return redirect()->route('cargo.index')->with('success','¡Creado Satisfactoriamente!');
    }
    public function show($id){
        $cargo = Cargo::find($id);
        return view('admin/cargo/show')->with('cargo',$cargo);
    }
    public function edit($id){
        $cargo = Cargo::find($id);
        return view('admin/cargo/edit')->with('cargo',$cargo);
    }
    public function update(Request $request,$id){
        //dd($request);
        $cargo = Cargo::find($id);
        $cargo->nombre = $request->nombre;
        $cargo->save();
        return redirect()->route('cargo.index')->with('success','¡Editado Satisfactoriamente!');
    }
    public function destroy($id){
        $cargo = Cargo::find($id);
        if($cargo->estado == 1){
            $cargo->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        }
        else{
            $cargo->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $cargo->save();
        return redirect()->route('cargo.index')->with('success',$mensaje);
    }
}

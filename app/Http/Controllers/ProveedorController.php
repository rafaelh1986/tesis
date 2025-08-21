<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware(['permission:proveedor.index'])->only('index');
        $this->middleware(['permission:proveedor.create'])->only('create');
        $this->middleware(['permission:proveedor.store'])->only('store');
        $this->middleware(['permission:proveedor.edit'])->only('edit');
        $this->middleware(['permission:proveedor.update'])->only('update');
        $this->middleware(['permission:proveedor.destroy'])->only('destroy');
        $this->middleware(['permission:proveedor.show'])->only('show');
    }
    public function index(Request $request){
        $perPage = $request->get('perPage', 10);
        $proveedores=Proveedor::paginate($perPage);
        return view('admin/proveedor/index', compact('proveedores','perPage'));
    }
    public function create(){
        return view('admin/proveedor/create');
    }
    public function store(Request $request){
        $request->validate([
        'razon_social' => 'required|string|max:255',
        'nit' => 'required|string|max:50|unique:proveedor,nit',
        'telefono' => 'required|string|max:50',
        'email' => 'required|email|max:255|unique:proveedor,email',
    ]);
        $proveedor = new Proveedor();
        $proveedor->razon_social = $request->razon_social;
        $proveedor->nit = $request->nit;
        $proveedor->telefono = $request->telefono;
        $proveedor->email = $request->email;
        $proveedor->save();
        return redirect()->route('proveedor.index')->with('success','¡Creado Satisfactoriamente!');
    }
    public function show($id){
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
        return redirect()->route('proveedor.index')->with('error', 'Proveedor no encontrado.');
    }
        return view('admin/proveedor/show')->with('proveedor',$proveedor);
    }
    public function edit($id){
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            return redirect()->route('proveedor.index')->with('error', 'Proveedor no encontrado.');
        }
        return view('admin/proveedor/edit')->with('proveedor',$proveedor);
    }
    public function update(Request $request,$id){
        $request->validate([
            'razon_social' => 'required|string|max:255',
            'nit' => 'required|string|max:50|unique:proveedor,nit,'.$id,
            'telefono' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:proveedor,email,'.$id,
        ]);
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
        return redirect()->route('proveedor.index')->with('error', 'Proveedor no encontrado.');
    }
        $proveedor->razon_social = $request->razon_social;
        $proveedor->nit = $request->nit;
        $proveedor->telefono = $request->telefono;
        $proveedor->email = $request->email;
        $proveedor->save();
        return redirect()->route('proveedor.index')->with('success','¡Editado Satisfactoriamente!');
    }
    public function destroy($id){
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
        return redirect()->route('proveedor.index')->with('error', 'Proveedor no encontrado.');
    }
        if($proveedor->estado == 1){
            $proveedor->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        }
        else{
            $proveedor->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $proveedor->save();
        return redirect()->route('proveedor.index')->with('success',$mensaje);
    }
}

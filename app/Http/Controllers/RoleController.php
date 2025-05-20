<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        //examples:
        $this->middleware(['permission:roles.index'])->only('index');
        $this->middleware(['permission:roles.create'])->only('create');
        $this->middleware(['permission:roles.store'])->only('store');
        $this->middleware(['permission:roles.edit'])->only('edit');
        $this->middleware(['permission:roles.update'])->only('update');
        $this->middleware(['permission:roles.destroy'])->only('destroy');
        $this->middleware(['permission:roles.show'])->only('show');
    }
    public function index(Request $request){
        //dd($request);
        $roles =Role::paginate(5);
        return view('admin/rol/index')->with('roles',$roles);
    }
    public function create(){
        
        return view('admin/rol/create');
    }
    public function store(Request $request){
        //dd($request);
        $rol = new Role();
        
        $rol->name = $request->name;
        //dd($rol);
        $rol->save();
        return redirect()->route('rol.index')->with('success','¡Creado Satisfactoriamente!');
    }
    public function show($id){
        $rol = Role::find($id);
        return view('admin/rol/show')->with('rol',$rol);
    }
    public function edit($id){
        $rol = Role::find($id);
        $permisos = Permission::all();
        return view('admin/rol/edit')->with('rol',$rol)->with('permisos',$permisos);
    }
    public function update(Request $request,$id){
        //dd($request);
        $rol = Role::find($id);
        $rol->name = $request->name;
        $rol->save();
        return redirect()->route('rol.index')->with('success','¡Editado Satisfactoriamente!');
    }
    public function destroy($id){
        $rol = Role::find($id);
        if($rol->estado == 1){
            $rol->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        }
        else{
            $rol->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $rol->save();
        return redirect()->route('rol.index')->with('success',$mensaje);
    }

    public function permiso(Request $request){
        //dd($request);
        $permisos = $request->permisos;
        $rol = Role::find($request->rol_id);
        foreach ($permisos as $permiso) {
            $rol->givePermissionTo($permiso);
        }
        return redirect()->route('rol.index');
    }
}

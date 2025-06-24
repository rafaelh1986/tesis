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
    public function index(Request $request)
    {
        //dd($request);
        $roles = Role::paginate(5);
        return view('admin/rol/index')->with('roles', $roles);
    }
    public function create()
    {

        return view('admin/rol/create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);
        $rol = new Role();
        $rol->name = $request->name;
        $rol->save();
        return redirect()->route('rol.index')->with('success', '¡Creado Satisfactoriamente!');
    }
    public function show($id)
    {
        $rol = Role::find($id);
        if (!$rol) {
        return redirect()->route('rol.index')->with('error', 'Rol no encontrado.');
    }
        return view('admin/rol/show')->with('rol', $rol);
    }
    public function edit($id)
    {
        $rol = Role::find($id);
        if (!$rol) {
        return redirect()->route('rol.index')->with('error', 'Rol no encontrado.');
    }
        $permisos = Permission::orderBy('name')->get();
        return view('admin/rol/edit')->with('rol', $rol)->with('permisos', $permisos);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
        'name' => 'required|string|max:255|unique:roles,name,'.$id,
    ]);
        $rol = Role::find($id);
        if (!$rol) {
            return redirect()->route('rol.index')->with('error', 'Rol no encontrado.');
        }
        // Verificar si el nombre del rol ya existe
        $rol->name = $request->name;
        $rol->save();
        return redirect()->route('rol.index')->with('success', '¡Editado Satisfactoriamente!');
    }
    public function destroy($id)
    {
        $rol = Role::find($id);
        if (!$rol) {
            return redirect()->route('rol.index')->with('error', 'Rol no encontrado.');
        }
        // Verificar si el rol ya existe
        // Cambiar el estado del rol
        if ($rol->estado == 1) {
            $rol->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        } else {
            $rol->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $rol->save();
        return redirect()->route('rol.index')->with('success', $mensaje);
    }

    public function permiso(Request $request)
    {
        $rol = Role::find($request->rol_id);
        if (!$rol) {
            return redirect()->route('rol.index')->with('error', 'Rol no encontrado.');
        }
        // Verificar si el rol ya existe
        $permisos = $request->permisos ?? []; // Si no hay permisos seleccionados, será un array vacío
        $rol->syncPermissions($permisos);
        return redirect()->route('rol.index')->with('success', 'Permisos actualizados correctamente');
    }
}

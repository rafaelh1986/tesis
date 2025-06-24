<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware(['permission:permiso.index'])->only('index');
        $this->middleware(['permission:permiso.create'])->only('create');
        $this->middleware(['permission:permiso.store'])->only('store');
        $this->middleware(['permission:permiso.edit'])->only('edit');
        $this->middleware(['permission:permiso.update'])->only('update');
        $this->middleware(['permission:permiso.destroy'])->only('destroy');
        $this->middleware(['permission:permiso.show'])->only('show');
    }

    public function index(Request $request)
    {
        //dd($request);
        $permisos = Permission::paginate(7);
        return view('admin/permiso/index')->with('permisos', $permisos);
    }
    public function create()
    {

        return view('admin/permiso/create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);
        $permiso = new Permission();

        $permiso->name = $request->name;
        //dd($permiso);
        $permiso->save();
        return redirect()->route('permiso.index')->with('success', '¡Creado Satisfactoriamente!');
    }
    public function show($id)
    {
        $permiso = Permission::find($id);
        if (!$permiso) {
            return redirect()->route('permiso.index')->with('error', 'Permiso no encontrado.');
        }
        return view('admin/permiso/show')->with('permiso', $permiso);
    }
    public function edit($id)
    {
        $permiso = Permission::find($id);
        if (!$permiso) {
            return redirect()->route('permiso.index')->with('error', 'Permiso no encontrado.');
        }
        return view('admin/permiso/edit')->with('permiso', $permiso);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
        ]);
        $permiso = Permission::find($id);
        $permiso->name = $request->name;
        $permiso->save();
        return redirect()->route('permiso.index')->with('success', '¡Editado Satisfactoriamente!');
    }
    public function destroy($id)
    {
        $permiso = Permission::find($id);
        if (!$permiso) {
            return redirect()->route('permiso.index')->with('error', 'Permiso no encontrado.');
        }
        $permiso = Permission::find($id);
        if ($permiso->estado == 1) {
            $permiso->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        } else {
            $permiso->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $permiso->save();
        return redirect()->route('permiso.index')->with('success', $mensaje);
    }
}

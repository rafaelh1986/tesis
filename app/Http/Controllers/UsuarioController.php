<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Persona;

use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware(['permission:usuario.index'])->only('index');
        $this->middleware(['permission:usuario.create'])->only('create');
        $this->middleware(['permission:usuario.store'])->only('store');
        $this->middleware(['permission:usuario.edit'])->only('edit');
        $this->middleware(['permission:usuario.update'])->only('update');
        $this->middleware(['permission:usuario.destroy'])->only('destroy');
        $this->middleware(['permission:usuario.show'])->only('show');
    }

    public function index(Request $request)
    {
        //dd($request);
        $usuarios = User::paginate(5);
        return view('admin/usuario/index')->with('usuarios', $usuarios);
    }
    public function create()
    {
        $personas = Persona::where('estado', 1)->get();
        return view('admin/usuario/create')->with('personas', $personas);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_persona' => 'required|exists:persona,id',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
        $usuario = new User();
        $usuario->id_persona = $request->id_persona;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        //dd($usuario);
        $usuario->save();
        return redirect()->route('usuario.index')->with('success', '¡Creado Satisfactoriamente!');
    }
    public function show($id)
    {
        $usuario = User::find($id);
        if (!$usuario) {
            return redirect()->route('usuario.index')->with('error', 'Usuario no encontrado.');
        }
        return view('admin/usuario/show')->with('usuario', $usuario);
    }
    public function edit($id)
    {
        $usuario = User::find($id);
        $roles = Role::all();
        return view('admin/usuario/edit')
            ->with('usuario', $usuario)
            ->with('roles', $roles);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
        'email' => 'required|email|max:255|unique:users,email,'.$id,
    ]);
        $usuario = User::find($id);
        $usuario->email = $request->email;
        $usuario->save();
        return redirect()->route('usuario.index')->with('success', '¡Editado Satisfactoriamente!');
    }
    public function destroy($id)
    {
        $usuario = User::find($id);
        if ($usuario->estado == 1) {
            $usuario->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        } else {
            $usuario->estado = 1;
            $mensaje = "Restaurado Satisfactoriamente!";
        }
        $usuario->save();
        return redirect()->route('usuario.index')->with('success', $mensaje);
    }
    public function reset_password($id)
    {
        $usuario = User::find($id);
        $password = $usuario->email;
        $usuario->password = bcrypt($password);
        $usuario->save();
        return redirect()->route('usuario.index');
    }

    public function asignar_roles(Request $request)
    {
        //dd($request);
        $roles = $request->roles;
        $usuario = User::find($request->usuario_id);
        $usuario->syncRoles($roles);
        return redirect()->route('usuario.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware(['permission:persona.index'])->only('index');
        $this->middleware(['permission:persona.create'])->only('create');
        $this->middleware(['permission:persona.store'])->only('store');
        $this->middleware(['permission:persona.edit'])->only('edit');
        $this->middleware(['permission:persona.update'])->only('update');
        $this->middleware(['permission:persona.destroy'])->only('destroy');
        $this->middleware(['permission:persona.show'])->only('show');
    }
    public function index(Request $request)
    {
        $personas = Persona::paginate(5);
        //dd($request);
        return view('admin/persona/index')->with('personas', $personas);
    }
    public function create()
    {
        return view('admin/persona/create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'ci' => 'required|string|max:20|unique:persona,ci',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
        ]);
        $persona = new Persona();
        $persona->ci = $request->ci;
        $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        //dd($persona);
        $persona->save();
        return redirect()->route('persona.index')->with('success', '¡Creado Satisfactoriamente!');
    }
    public function show($id)
    {
        $persona = Persona::find($id);
        if (!$persona) {
            return redirect()->route('persona.index')->with('error', 'Persona no encontrada.');
        }
        return view('admin/persona/show')->with('persona', $persona);
    }
    public function edit($id)
    {
        $persona = Persona::find($id);
        if (!$persona) {
            return redirect()->route('persona.index')->with('error', 'Persona no encontrada.');
        }
        return view('admin/persona/edit')->with('persona', $persona);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
        ]);
        $persona = Persona::find($id);
        $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->save();
        return redirect()->route('persona.index')->with('success', '¡Editado Satisfactoriamente!');
    }
    public function destroy($id)
    {
        $persona = Persona::find($id);
        if ($persona->estado == 1) {
            $persona->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        } else {
            $persona->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $persona->save();
        return redirect()->route('persona.index')->with('success', $mensaje);
    }
}

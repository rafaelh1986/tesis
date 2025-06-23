<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Empleado;
use App\Models\Persona;
use App\Models\Ciudad;
use App\Models\Cargo;
use App\Models\Area;

class EmpleadoController extends Controller
{
    //
    public function __construct()
    {
        
        $this->middleware(['permission:empleado.index'])->only('index');
        $this->middleware(['permission:empleado.create'])->only('create');
        $this->middleware(['permission:empleado.store'])->only('store');
        $this->middleware(['permission:empleado.edit'])->only('edit');
        $this->middleware(['permission:empleado.update'])->only('update');
        $this->middleware(['permission:empleado.destroy'])->only('destroy');
        $this->middleware(['permission:empleado.show'])->only('show');
    }

    public function index(Request $request){
        //dd($request);
        $empleados =Empleado::paginate(5);
        return view('admin/empleado/index')->with('empleados',$empleados);
    }
    public function create(){
        $personas = Persona::where('estado',1)->get();
        $areas = Area::where('estado',1)->get();
        $ciudades = Ciudad::where('estado',1)->get();
        $cargos = Cargo::where('estado',1)->get();
        return view('admin/empleado/create')->with('personas',$personas)->with('areas',$areas)
            ->with('ciudades',$ciudades)->with('cargos',$cargos);
    }
    public function store(Request $request){
        $request->validate([
            'id_persona' => 'required|exists:personas,id',
            'id_area' => 'required|exists:areas,id',
            'id_ciudad' => 'required|exists:ciudads,id',
            'id_cargo' => 'required|exists:cargos,id',
            'email' => 'required|email|max:255',
            'telefono_interno' => 'nullable|string|max:50',
            'fecha_ingreso' => 'required|date',
            'fecha_salida' => 'nullable|date',
        ]);
        //dd($request);
        $empleado = new Empleado();
        $empleado->id_persona = $request->id_persona;
        $empleado->id_area = $request->id_area;
        $empleado->id_ciudad = $request->id_ciudad;
        $empleado->id_cargo = $request->id_cargo;
        $empleado->email = $request->email;
        $empleado->telefono_interno = $request->telefono_interno;
        $empleado->fecha_ingreso = $request->fecha_ingreso;
        $empleado->fecha_salida = $request->fecha_salida;

        $persona = Persona::find($request->id_persona);
        $persona->estado = 2;
        //dd($persona);
        $persona->save();
        
        $empleado->save();
        return redirect()->route('empleado.index')->with('success','¡Creado Satisfactoriamente!');
    }
    public function show($id){
        $empleado = Empleado::find($id);
        if (!$empleado) {
            return redirect()->route('empleado.index')->with('error', 'Empleado no encontrado.');
        }
        // Usando relaciones definidas en el modelo Empleado
        return view('admin/empleado/show')
            ->with('empleado', $empleado)
            ->with('area', $empleado->area)
            ->with('ciudad', $empleado->ciudad)
            ->with('cargo', $empleado->cargo);
    }
    public function edit($id){
        $empleado = Empleado::find($id);
        if (!$empleado) {
            return redirect()->route('empleado.index')->with('error', 'Empleado no encontrado.');
        }
        $areas = Area::where('estado',1)->get();
        $ciudades = Ciudad::where('estado',1)->get();
        $cargos = Cargo::where('estado',1)->get();

        return view('admin/empleado/edit')
        ->with('empleado',$empleado)
        ->with('areas', $areas)
        ->with('ciudades', $ciudades)
        ->with('cargos', $cargos);
    }
    public function update(Request $request,$id){
        $request->validate([
            'id_persona' => 'required|exists:personas,id',
            'id_area' => 'required|exists:areas,id',
            'id_ciudad' => 'required|exists:ciudads,id',
            'id_cargo' => 'required|exists:cargos,id',
            'email' => 'required|email|max:255',
            'telefono_interno' => 'nullable|string|max:50',
            'fecha_ingreso' => 'required|date',
            'fecha_salida' => 'nullable|date',
        ]);
        $empleado = Empleado::find($id);
        if (!$empleado) {
            return redirect()->route('empleado.index')->with('error', 'Empleado no encontrado.');
        }
                
        $empleado->id_area = $request->id_area;
        $empleado->id_ciudad = $request->id_ciudad;
        $empleado->id_cargo = $request->id_cargo;
        $empleado->email = $request->email;
        $empleado->telefono_interno = $request->telefono_interno;
        
        $empleado->fecha_salida = $request->fecha_salida;
        $empleado->save();
        return redirect()->route('empleado.index')->with('success','¡Editado Satisfactoriamente!');
    }
    public function destroy($id){
        $empleado = Empleado::find($id);
        if (!$empleado) {
            return redirect()->route('empleado.index')->with('error', 'Empleado no encontrado.');
        }
        
        if($empleado->estado == 1){
            $empleado->estado = 0;
            $mensaje = "¡Eliminado Satisfactoriamente!";
        }
        else{
            $empleado->estado = 1;
            $mensaje = "¡Restaurado Satisfactoriamente!";
        }
        $empleado->save();
        return redirect()->route('empleado.index')->with('success',$mensaje);
    }
        
}

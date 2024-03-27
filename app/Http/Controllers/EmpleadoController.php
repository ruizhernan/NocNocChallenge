<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
{
   
    public function index()
    {
        $empleados = Empleados::all();
        return Inertia::render('Empleados/Index', ['empleados'=>$empleados]);
        
    }

   
    public function create()
    {
        return Inertia::render('Empleados/Crear');
    }

    
    public function store(Request $request)
    {
        info('Empleado a crear'.$request->id);
        try {
            $request->validate([
                'nombre' => 'required|max:150',
                'clave' => 'required|min:8|max:255'
            ]);

            $hashedPassword = Hash::make($request->input('clave'));

            $empleado = new Empleados([
                'nombre' => $request->input('nombre'),
                'correo' => $request->input('correo'),
                'clave' => $hashedPassword,
                'ResetPw' => $request->input('ResetPw')
            ]);
            info('Empleado a crear'.$request->id);
            $empleado->save();

            return redirect('empleados')->with('success', 'Empleado creado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo crear el empleado.');
        }
    }
  
    // public function show(Empleados $empleados)
    // {
    //     //
    // }

    
    public function edit(Empleados $empleado)
    {
        return Inertia::render('Empleados/Editar',['empleado' => $empleado]);

    }

   
    public function update(Request $request, Empleados $empleado)
    {
        try {
            $request->validate(['nombre' => 'required|max:150']);
            $empleado->update($request->all());
            return redirect('empleados');
            info('Id del empleado a actualizar'.$empleado->id);
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo actualizar el empleado.');
        }
    }

    
    // public function destroy(Empleados $empleados)
    // {
    //     info('ID del empleado a eliminar: '.$empleados->id);
    //     $empleados->delete();
    //     return redirect('empleados');
    // }

    public function destroy($id)
    {
        try {
            $empleado = Empleados::findOrFail($id);
            info('ID del empleado a eliminar: '.$empleado->id);
            $empleado->delete();
            return redirect('empleados');
        } catch (\Exception $e) {
            
            return back()->with('error', 'No se pudo eliminar el empleado.');
        }
    }

  
}

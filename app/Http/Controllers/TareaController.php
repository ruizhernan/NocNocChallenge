<?php

namespace App\Http\Controllers;

use App\Models\Tareas;
use App\Models\Empleados;
use App\Models\Comentarios;
use App\Models\Adjuntos;
use Inertia\Inertia;    
use Illuminate\Http\Request;
use DB;

class TareaController extends Controller
{
   
    public function index()
    {
        $tareas = Tareas::all();
        return Inertia::render('Tareas/Index', ['tareas'=>$tareas]);
    }

    
    public function create()
    {
        return Inertia::render('Tareas/Crear');
    }

    
    public function store(Request $request)
    {
        try {
            $request->validate(['titulo' => 'required|max:150']);
    
            $tarea = new Tareas($request->input());
            $tarea->save();
            info('Tarea '.$tarea->id);
          
            return redirect('tareas');
        } catch (\Exception $e) {
             return back()->with('error', 'Error al guardar la tarea.');
        }
    }

    
    public function show(Tareas $tareas)
    {
        //
    }

    public function edit(Tareas $tarea)
    {
        return Inertia::render('Tareas/Editar',['tarea' => $tarea]);
    }

    public function update(Request $request, Tareas $tarea)
    {
        $request->validate([
            'titulo' => 'required|max:150',
            'empleado_id' => 'required|exists:empleados,id', // Validar que el nuevo empleado exista en la tabla de empleados
        ]);
    
        try {
            info('Tarea a editar: '.$tarea->id.$request->empleado_id);
            $tarea->update($request->all());
            info('Id de la tarea a editar'.$tarea->id.$tarea->empleado_id);
            return redirect('tareas');
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo actualizar la tarea.');
        }
    }

    public function destroy($id)
    {
        try {
          
            Comentarios::where('tarea_id', $id)->delete();
            Adjuntos::where('tarea_id', $id)->delete();
            
            
            $tarea = Tareas::findOrFail($id);
            $tarea->delete();
            
            return redirect('tareas');
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo eliminar la tarea.');
        }
    }
    

    
    public function TareasPorEmpleado(){
        $empleados = Empleados::select('empleados.id','empleados.nombre','tareas.name as TareasAsignadas')
        ->join('tareas','tareas.id','=','tareas.empleado_id')
        ->get();

        $tareas = Tareas::all();
        return Inertia::render('Tareas/TareasPorEmpleado'.['empleados' => $empleados, 'tareas' => $tareas]);
    }
}

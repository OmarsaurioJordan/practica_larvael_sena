<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $datos = Categoria::all();
        return view('categorias.index', compact('datos'));
    }

    public function create()
    {
        return view('categorias.new');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:50',
            'descripcion' => 'required|max:200'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        else {
            Categoria::create($request->all());
            return redirect('categorias')->with('type', 'success')->with('message', 'Categoría creada exitosamente');
        }
    }

    public function edit(string $id)
    {
        $datos = Categoria::find($id);
        return view('categorias.edit', compact('datos'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:50',
            'descripcion' => 'required|max:200'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        else {
            $categoria->update($request->all());
            return redirect('categorias')->with('type', 'warning')->with('message', 'Categoría actualizada exitosamente');
        }
    }

    public function destroy(string $id)
    {
        Categoria::destroy($id);
        return redirect('categorias')->with('type', 'danger')->with('message', 'El registro se eliminó');
    }
}

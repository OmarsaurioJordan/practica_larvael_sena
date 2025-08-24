<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('verificar:ver_productos')->only('index');
        $this->middleware('verificar:crear_productos')->only('create', 'store');
        $this->middleware('verificar:editar_productos')->only('edit', 'update');
        $this->middleware('verificar:eliminar_productos')->only('destroy');
        $this->middleware('verificar:ver_detalle_productos')->only('show');
    }

    public function index()
    {
        $datos = Producto::all();
        return view('productos.index', compact('datos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.new', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:50',
            'descripcion' => 'max:200',
            'foto' => 'max:200',
            'precio' => 'required|numeric|min:0|max:999999.99',
            'cantidad' => 'required|integer|min:0|max:1000000',
            'categoria_id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        else {
            Producto::create($request->all());
            return redirect('productos')->with('type', 'success')->with('message', 'Registro creado exitosamente');
        }
    }

    public function edit(string $id)
    {
        $datos = Producto::find($id);
        $categorias = Categoria::all();
        return view('productos.edit', compact('datos', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:50',
            'descripcion' => 'max:200',
            'foto' => 'max:200',
            'precio' => 'required|numeric|min:0|max:999999.99',
            'cantidad' => 'required|integer|min:0|max:1000000',
            'categoria_id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        else {
            $producto->update($request->all());
            return redirect('productos')->with('type', 'warning')->with('message', 'Registro actualizado exitosamente');
        }
    }

    public function destroy(string $id)
    {
        Producto::destroy($id);
        return redirect('productos')->with('type', 'danger')->with('message', 'El registro se eliminó');
    }
}

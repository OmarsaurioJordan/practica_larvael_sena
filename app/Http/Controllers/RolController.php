<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Rol;

class RolController extends Controller
{
    public function index() {
        $datos = Rol::all();
        return view('rols.index', compact('datos'));
    }
    public function create() {
        return view('rols.new');
    }
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:50'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        else {
            Rol::create($request->all());
            return redirect('rols')->with('type', 'success')->with('message', 'Registro creado exitosamente');
        }
    }
    public function edit(string $id) {
        $datos = Rol::find($id);
        return view('rols.edit', compact('datos'));
    }
    public function update(Request $request, Rol $rol) {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:50'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        else {
            $rol->update($request->all());
            return redirect('rols')->with('type', 'warning')->with('message', 'Registro actualizado exitosamente');
        }
    }
    public function destroy(string $id) {
        Rol::destroy($id);
        return redirect('rols')->with('type', 'danger')->with('message', 'El registro se eliminó');
    }
}

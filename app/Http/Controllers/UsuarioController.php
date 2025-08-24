<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Usuario;
use App\Models\Rol;
use App\Models\Accion;
use Auth;
use Hash;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('verificar:ver_usuarios')->only('index');
        $this->middleware('verificar:crear_usuarios')->only('create', 'store');
        $this->middleware('verificar:editar_usuarios')->only('edit', 'update');
        $this->middleware('verificar:eliminar_usuarios')->only('destroy');
        $this->middleware('verificar:ver_detalle_usuarios')->only('show');
    }

    public function check(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('home');
        }
        return redirect('login')->with('type', 'danger')->with('message', 'Usuario o contraseña incorrectos');
    }

    public function index()
    {
        $datos = Usuario::all();
        return view('usuarios.index', compact('datos'));
    }

    public function create()
    {
        $rols = Rol::all();
        return view('usuarios.new', compact('rols'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:50',
            'telefono' => 'required|max:50',
            'rol_id' => 'required',
            'email' => 'required|max:100',
            'password' => 'required|max:200',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        else {
            $datos = $request->all();
            $datos['password'] = hash::make($datos['password']);
            $datos['permisos'] = "";
            Usuario::create($datos);
            return redirect('usuarios')->with('type', 'success')->with('message', 'Registro creado exitosamente');
        }
    }

    public function edit(string $id)
    {
        $rols = Rol::all();
        $accions = Accion::all();
        $datos = Usuario::find($id);
        return view('usuarios.edit', compact('datos', 'rols', 'accions'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:50',
            'telefono' => 'required|max:50',
            'rol_id' => 'required',
            'email' => 'required|max:100',
            'password' => 'required|max:200'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        else {
            $datos = $request->all();
            $datos['password'] = hash::make($datos['password']);
            $seleccionadas = $request->input('accions', []);
            $datos['permisos'] = implode(',', $seleccionadas);
            $usuario->update($datos);
            return redirect('usuarios')->with('type', 'warning')->with('message', 'Registro actualizado exitosamente');
        }
    }

    public function destroy(string $id)
    {
        Usuario::destroy($id);
        return redirect('usuarios')->with('type', 'danger')->with('message', 'El registro se eliminó');
    }
}

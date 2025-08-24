Se modificará el `Tutorial.md` para lograr:

# Sistema con acciónes asociadas directamente a los usuarios

- romper asociación `Rols/Permisos` y crear asociación `Usuarios/Permisos`, esto se hace en los modelos con el hasMany y etc, también con la llave foránea al definir las tablas, etc

- cambiar `rol_id` de la tabla Permisos por `usuario_id`, esto implica cambiar el nombre en varios modelos, vistas y etc

- en UsuarioController:
```
public function create()
{
    $datos = Accion::all();
    return view('usuarios.new', compact('datos'));
}
```

- en el modelo Usuarios la función `tienePermiso` ahora queda
```
return $this->rol && $this->permiso->contains... etc
```

- ahora `accion_id` es un varchar para guardar array de acciónes no atómico y Acciónes se desvincula de Permisos.

- en RolController, el `foreach` que crea varios registros de acciónes, ahora va a concatenar en JSON y luego se sube una sola vez a la DB.

- copiar y pegar ese código a usuarioCreate en UserController.

- la vista de creación y edición Usuario, es la que tiene los checkbox de las acciónes.

## Resultado

Finalmente se colocó un atributo permisos en Usuarios, se eliminó la tabla permisos y se desconectó totalmente la Acciones, entonces cada usuario guarda un varchar con formato CSV con los nombres de los permisos, estos se pueden editar desde edición de usuario

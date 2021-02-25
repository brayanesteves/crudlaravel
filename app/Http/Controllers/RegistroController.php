<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegistroRequest;

class RegistroController extends Controller
{
    /**
     * Va a redireccionar a la lista de registros
     * Formulario de Registro
     */
    public function index() {
        return view('registro.index');
    }

    public function registrar(RegistroRequest $request) {
        /**
         * Es para hacer un pequeño 'test'
         */
        //dd($request->all());
        $email = $request->input('email');
        $password = $request->input('password');
        $nombres = $request->input('nombres');
        $apellidos = $request->input('apellidos');
        $telefono = $request->input('telefono');
        $documentoidentificacion = $request->input('documentoidentificacion');
        $fechadenacimiento = $request->input('fechadenacimiento');

        $nuevoUsuario = new User();
        $nuevoUsuario->email = $email;
        $nuevoUsuario->password = encrypt($password);
        $nuevoUsuario->nombres = $nombres;
        $nuevoUsuario->apellidos = $apellidos;
        $nuevoUsuario->telefono = $telefono;
        $nuevoUsuario->documentoindentificacion = $documentoidentificacion;
        $nuevoUsuario->fechadenacimiento = $fechadenacimiento;
        // 2 = Usuario
        $nuevoUsuario->rol = 2;
        $nuevoUsuario->estado = 1;
        // Guarda el registro
        $nuevoUsuario-save();

        return response()->json([
            "mensaje" => "Se ha registrado con éxito",
            "usuario" => $nuevoUsuario
        ]);
    }
}

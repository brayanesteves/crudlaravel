<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller {
    public function index() {
        return view('login.index');
    }

    public function validarCredenciales(LoginRequest $request) {
        //dd($request->all());
        $email = $request->input('email');
        $password = $request->input('password');
        $recuerdame = $request->input('recuerdame');
        $respuesta = [];

        $emailExistente = DB::table('users')->where('email', $email)->where('estado', 1)->first();
        //dd($emailExistente);
        if(!empty($emailExistente)) {
            $passwordDesencriptada = dcrypt($emailExistente->password);
            if($password == $passwordDesencriptada) {
                $respuesta["error"] = false;
                $respuesta["mensaje"] = "Usuario autenticado";
                $respuesta["usuario"] = $emailExistente;
                auth()->loginUsingId($emailExistente->Rfrnc, $recuerdame);
            } else {
                $respuesta["error"] = true;
                $respuesta["mensaje"] = "Este usuario no existe";
            }
        } else {
            $respuesta["error"] = true;
            $respuesta["mensaje"] = "Este usuario no existe";
        }
        return response()->json($respuesta);
    }

    public function cerrarSesion() {
        auth()->logout();
        session()->flush();

        return redirect()->route('login.index');
    }
}

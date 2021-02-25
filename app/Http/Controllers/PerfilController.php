<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller {
    public function index() {
        //dd(auth()->user());
        $usuario = User::find(auth()->user()->Rfrnc);
        return view('perfil.index')->with(compact('email'));
    }
}

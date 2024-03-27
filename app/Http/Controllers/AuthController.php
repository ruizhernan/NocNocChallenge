<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use APP\Http\Controllers\EmpleadoController;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;


class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
         $validator = $request->validate(['nombre' => 'required|max:150',
        'email' => 'required|string|email|max:255|unique:empleado',
        'password' => 'required|string|min:8'
        ]);


    }
}

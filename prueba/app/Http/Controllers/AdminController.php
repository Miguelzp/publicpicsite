<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Storage;
use App\Models\Spot;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        //le pasamos a la vista de administrador todos los spots y usuarios para que pueda manejarlos
        $spots = Spot::all();
        $users = User::all();

        return view('admin')->with('spots', $spots)->with('users', $users);
    }
}

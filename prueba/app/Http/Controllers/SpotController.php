<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Storage;
use App\Models\Spot;
use App\Models\User;
use Illuminate\Http\Request;


class SpotController extends Controller
{
    
    public function index()
    {
        //en la siguiente variable se almacenan todos los registros de spot
        $spots = Spot::all();
        return view('dashboard')->with('spots', $spots);
    }
    public function mios()
    {
        //Condicion para mostrar solo mis spots
        $usuario = Auth::user()->id;
        $spots = Spot::all()->where('user_id', $usuario);

        return view('mySpots', ['spots' => $spots]);

    }
    public function store(Request $request){

        $request->validate([
            
            'file' => 'required|image',
            
        ]);
        $imagenes = $request->file('file')->store('public/imagenes');
        $url = Storage::url($imagenes);

        $spots = new Spot();
        $spots->name = $request->name;
        $spots->descripcion = $request->descripcion;
        $spots->latitud = $request->latitud;
        $spots->longitud = $request->longitud;

       Spot::create([
           'name' => $spots->name,
           'url' => $url,
           'descripcion' => $spots->descripcion,
           'latitud' => $spots->latitud,
           'longitud' => $spots->longitud,
           'user_id' => auth()->user()->id,
       ]);

       //Al crear un nuevo spot te redirigirá a la página de explorador de spots
       return redirect()->route('dashboard');
    }

    public function destroy($id){
        
        $spot = Spot::find($id);
        //Para borrar la imagen del servidor, no solo la url de nuestra base de datos, tenemos que cambiarle la url de donde se almacena por la siguiente.
        $url = str_replace('storage','public',$spot->url);
        Storage::delete($url);

        $spot->delete();
        if(Auth::user()->rol == "administrador"){
            return redirect()->route('configuracion');
        }
        return redirect()->route('mios');
        
    }

    public function edit($id){

        $spot = Spot::find($id);
        return view('editar', compact('spot'));  
    }
    public function update(Request $request, $id){

        $spot = Spot::find($id);
        $spot->update($request->all());
        if(Auth::user()->rol == "administrador"){
            return redirect()->route('configuracion');
        }
        return redirect('mySpots');  
    }

    //Para editar y borrar los usuarios
    public function editU($id){

        $user = User::find($id);
        return view('editarU', compact('user'));  
    }
    public function updateU(Request $request, $id){

        $user = User::find($id);
        $user->update($request->all());
        if(Auth::user()->rol == "administrador"){
            return redirect()->route('configuracion');
        }
        return redirect('usuario');  
    }
    public function destroyU($id){
        
        $usuario = User::find($id);
        $usuario->delete();
        if(Auth::user()->rol == "administrador"){
            return redirect()->route('configuracion');
        }
        return redirect()->route('/');
    }

    public function perfil(){

        //Condicion para mostrar solo mis spots
        $usuario = Auth::user()->id;
        $spots = Spot::all()->where('user_id', $usuario);

        return view('perfilusuario', ['spots' => $spots]);
    }

    public function show(){

        $spots = \App\Models\Spot::all();
        return view("spots", array('spots'=>$spots)); 
    }
}
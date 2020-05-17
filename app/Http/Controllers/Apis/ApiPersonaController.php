<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Persona;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ApiPersonaController extends Controller
{

    public function __construct(){
        $this->middleware('guest');
    }

    public function index(Request $request){
        return Persona::all();
    }

   /* public function store(Request $request){

    }*/

    public function store(Request $request)
    {
       /* return Persona::insert('insert into persona (nombre,apellido,nombre_usuario,telefono,sexo,email,direccion,fecha_nacimiento
        ,password) values (?,?,?,?,?,?,?,?,?)', [$request->nombre,$request->apellido,$request->nombre_usuario
        ,$request->telefono,$request->sexo,$request->email,$request->direccion,$request->fecha_nacimiento
        ,$request->password]);
        */
        $email=Persona::where('email',$request->email)->first();
        $nombre_usuario=Persona::where('nombre_usuario',$request->nombre_usuario)->first();

        if (!is_null($email)){
            return response()->json('Ya existe este email',500);
        }
        if (!is_null($nombre_usuario)){
            return response()->json('Ya existe este nombre de usuario',500);  
        }

        if ($request->password==$request->confirm_password){
            
        }else{
            return response()->json('La confirmacion de la contraseña es incorrecta',500);  
        }

        $datos=["nombre"=>$request->nombre,
        "apellido"=>$request->apellido,
        "nombre_usuario" =>$request->nombre_usuario,
        "telefono"=>$request->telefono,
        "sexo"=>$request->sexo,
        "email"=>$request->email,
        "direccion"=>$request->direccion,
        "fecha_nacimiento"=>$request->fecha_nacimiento,
        "password"=>Hash::make($request->password)
    ];

        $persona=Persona::create($datos);

        return response()->json($persona,200);
    }


    public function login(Request $request){
        $personaConsulta=DB::table('persona')->where('nombre_usuario','=',$request->nombre_usuario)->first();
        $persona=Persona::where('nombre_usuario',$request->nombre_usuario)->first();
        if (Hash::check($request->password, $persona->password)){
            return response()->json($persona,200); 
        }

        return response()->json('Los datos introducidos son incorrectos',500);  
    }


}
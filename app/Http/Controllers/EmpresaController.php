<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Empresa;
use Auth;
use Hash;
use DB;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $empresas=Empresa::join('users',function($join){


            $join->on("empresa.user_id", "=", "users.id");

        })->select('empresa.*','users.*')->get();
        return view("empresa.index",compact('empresas'));
    }

      /**
     * Registrar.
     *
     * @return \Illuminate\Http\Response
     */
    public function registrar()
    {
        return view("empresa/registrar");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $clave=$request->password;
        $request['password']=Hash::make($clave); 
        $request['name']=$request->name;
        $request['apellido']=$request->apellido; 
        $request['rif_usuario']=$request->rif_usuario;  
        $request['email']=$request->email;
        $request['telefono']=$request->telefono;
        $request['token']='';
        $request['remember']='';
        $request['password_confirmation']='';

        User::create($request->all());

      

        $usuario=User::where("email","=",$request->email)->first();
        $request['user_id']=$usuario->id;
        Empresa::create($request->all());

        

        return redirect("registrar_empresa")->with('mensaje','Se Registró Correctamente la Empresa y Usuario');
    }

            /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function consultar_email(Request $request)
    {


        $user=User::where("email","=",$request->email)->first();
        if(isset($user)){
            $arrEmail[1]=1;
        }else{
            $arrEmail[1]=0;
        }
        
        return response()->json($arrEmail);

        //return redirect('cuenta_bancarias')->with('mensaje','La Cuenta se guardó Correctamente');

    }

            /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function consultar_rif(Request $request)
    {


        $empresa=Empresa::where("rif_empresa","=",$request->rif)->first();
        if(isset($empresa)){
            $arrRif[1]=1;
        }else{
            $arrRif[1]=0;
        }
        
        return response()->json($arrRif);

        //return redirect('cuenta_bancarias')->with('mensaje','La Cuenta se guardó Correctamente');

    }

          /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function consultar_rif_usuario(Request $request)
    {


        $user=User::where("rif_usuario","=",$request->rif_usuario)->first();
        if(isset($user)){
            $arrUser[1]=1;
        }else{
            $arrUser[1]=0;
        }
        
        return response()->json($arrUser);

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

  
@extends('layouts.app')
@section('content')     

<div class="container">  
            <div class='row justify-content-center'>
              <div class="col-md-6">
              <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre Empresa</th>
                    <th scope="col">Rif</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Nombre y Apellido</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empresas as $empresa)
                    <tr>
                    <th scope="row">{{$empresa->id}}</th>
                    <td>{{$empresa->nombre_empresa}}</td>
                    <td>{{$empresa->rif_empresa}}</td>
                    <td>{{$empresa->telefono_empresa}}</td>
                    <td>{{$empresa->email}}</td>
                    <td>{{$empresa->name}} {{$empresa->apellido}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

    </div> 
</div>

@endsection
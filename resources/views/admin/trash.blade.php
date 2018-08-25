@extends('adminlte::page')
@section('title','Lixeira de Administrador')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('notification'))
                <div class="alert alert-success">
                    <p>{{session()->get('notification')}}</p>
                </div>
            @endif
            @if(isset($admins) && count($admins) >= 0)
             <div class="panel panel-default">
            <div class="panel-body" style="padding: 15px 15px 0px 15px !important;">
            <table class="table table-bordered" >
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Tipo de Credenciamento</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($admins->all() as $admin)
                    <tr>
                            <td >{{$admin->name}}</td>
                            <td >{{$admin->email}}</td>
                            <td >{{ $admin->role ? 'Administrador Geral' : 'Gerente de Pedidos'}}</td> 
                            <td class="text-center">
                            <a href="{{route('editAdmin',$admin->id)}}" type="button" class="btn btn-primary btn-flat">Editar</a>
                            <a href="{{route('restoreAdmin',$admin->id)}}" type="button" class="btn btn-danger btn-flat">Restaurar</a>
                            </td>
                    </tr>
                @endforeach  
                </tbody>
            </table>
            </div>
            </div>
            <div class="pull-right" style="margin: 0px;padding: 0px">
                    {!! $admins->links() !!}
                </div>
            @endif
        </div>
        </div>
    </div>
@endsection
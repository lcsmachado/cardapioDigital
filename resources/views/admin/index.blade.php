@extends('adminlte::page')
@section('title','Painel de Administrador')
@section('content')

    <div class="row">
        <div class="col-md-12">
            @if(session()->has('notification'))
                <div class="alert alert-success">
                    <p>{{session()->get('notification')}}</p>
                </div>
            @endif
            <a href="{{route('createAdmin')}}" type="button" style="margin-bottom:10px" class="btn btn-info btn-flat">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp; Novo Administrador
            </a>
            <a href="{{route('trashAdmin')}}" type="button" class="btn btn-danger btn-flat" style="margin-bottom: 10px;">
                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Lixeira
            </a>
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
                            <td >@if($admin->role == 'admin')Administrador Geral @else Gerente de Pedidos @endif</td> 
                            <td >
                            <form  method="POST" action="{{route('destroyAdmin',$admin->id)}}">
                                {!! method_field('DELETE') !!}
                                {!! csrf_field() !!}
                                <a href="{{route('editAdmin',$admin->id)}}" type="button" class="btn btn-primary btn-flat">Editar</a>
                                <button href="{{route('destroyAdmin',$admin->id)}}" type="submit" class="btn btn-danger btn-flat">Excluir</button>
                            </form>
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
    @endsection
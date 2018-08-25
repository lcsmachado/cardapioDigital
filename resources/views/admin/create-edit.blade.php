@extends('adminlte::page')
@section('title','Cadastro de Administrador')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('notification'))
                <div class="alert alert-success">
                    <p>{{session()->get('notification')}}</p>
                </div>
            @endif
            @if(isset($errors) && count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif
            <div class="panel panel-default">
            <div class="panel-heading"><h4>Cadastro de Administrador</h4></div>
            <div class="panel-body">
            @if(isset($admin))
                <form role="form" method="POST" action="{{route('updateAdmin',$admin->id)}}">
                    {!! method_field('PUT') !!}
                    @else
                        <form role="form" method="POST" action="{{route('storeAdmin')}}">
            @endif
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$admin->name or old('name')}}" placeholder="{{$admin->name or old('name')}}">
            </div>
            <div class="form-group">
                <label for="name">Email</label>
                <input type="email" class="form-control" id="email" name="email"  value="{{$admin->email or old('email')}}" placeholder="{{$admin->email or old('email')}}">
            </div>
            <div class="form-group">
                <label for="name">Senha</label>
                <input type="password" class="form-control" id="password" name="password" placeholder"Senha">
            </div>
            <div class="form-group">
                <label for="name">Confirmar Senha</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder"Confirmar Senha">
            </div>
            <div class="form-group">
                <label for="name">Pergunta Secreta</label>
                <input type="text" class="form-control" id="secret_question" name="secret_question" value="{{$admin->secret_question or old('secret_question')}}" placeholder"Pergunta Secreta">
            </div>
            <div class="form-group">
                <label for="name">Resposta Senha</label>
                <input type="text" class="form-control" id="secret_answer" value="{{$admin->secret_answer or old('secret_answer')}}" name="secret_answer" placeholder"Confirmar Senha">
            </div>
            <div class="form-group">
                    <label for="name">Tipo de Administrador</label>
                    <select name="role" id="role">
                        <option value="">Selecione</option>
                        <option value="admin" @if(isset($admin) && $admin->role == 'admin') selected @endif>Administrador Geral</option>
                        <option value="user"@if(isset($admin) && $admin->role == 'user') selected @endif>Gerente de Pedidos</option>
                    </select>
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
            </form>
            </div>
            </div>
        </div>
    </div>
@endsection
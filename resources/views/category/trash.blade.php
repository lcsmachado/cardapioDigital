@extends('adminlte::page')
@section('title','Lixeira de Categorias')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" style="margin-top: 2%">
            @if(session()->has('notification'))
                <div class="alert alert-success">
                    <p>{{session()->get('notification')}}</p>
                </div>
            @endif
            @if(isset($categories) && count($categories) >= 0)
             <div class="panel panel-default">
            <div class="panel-body" style="padding: 15px 15px 0px 15px !important;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($categories->all() as $category)
                    <tr>
                            <td>{{$category->name}}</td>
                            <td>
                            <a href="{{route('editCategory',$category->id)}}" type="button" class="btn btn-primary btn-flat">Editar</a>
                            <a href="{{route('restoreCategory',$category->id)}}" type="button" class="btn btn-danger btn-flat">Restaurar</a>
                        </td>
                    </tr>
                @endforeach  
                </tbody>
            </table>
            </div>
            </div>
            <div class="pull-right" style="margin: 0px;padding: 0px">
                    {!! $categories->links() !!}
                </div>
            @endif
        </div>
        </div>
    </div>
@endsection
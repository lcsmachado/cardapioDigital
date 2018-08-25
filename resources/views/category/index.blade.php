@extends('adminlte::page')
@section('title','Painel de Categorias')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('notification'))
                <div class="alert alert-success">
                    <p>{{session()->get('notification')}}</p>
                </div>
            @endif
            <a href="{{route('createCategory')}}" type="button" style="margin-bottom:10px" class="btn btn-info btn-flat">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp; Nova Categoria
            </a>
            <a href="{{route('trashCategory')}}" type="button" class="btn btn-danger btn-flat" style="margin-bottom: 10px;">
                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Lixeira
            </a>
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
                            <form  method="POST" action="{{route('destroyCategory',$category->id)}}">
                                {!! method_field('DELETE') !!}
                                {!! csrf_field() !!}
                                <a href="{{route('editCategory',$category->id)}}" type="button" class="btn btn-primary btn-flat" >Editar</a>
                                <button href="{{route('destroyCategory',$category->id)}}" type="submit" class="btn btn-danger btn-flat">Excluir</button>
                            </form>
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
    @endsection
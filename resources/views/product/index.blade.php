@extends('adminlte::page')
@section('title','Painel de Produtos')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('notification'))
                <div class="alert alert-success">
                    <p>{{session()->get('notification')}}</p>
                </div>
            @endif
            <a href="{{route('createProduct')}}" type="button" style="margin-bottom:10px" class="btn btn-info btn-flat">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp; Novo Produto
            </a>
            <a href="{{route('trashProduct')}}" type="button" class="btn btn-danger btn-flat" style="margin-bottom: 10px;">
                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Lixeira
            </a>
            @if(isset($products) && count($products) >= 0)
            <div class="panel panel-default">
            <div class="panel-body" style="padding: 15px 15px 0px 15px !important;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($products->all() as $product)
                    <tr>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>
                            <form  method="POST" action="{{route('destroyProduct',$product->id)}}">
                                {!! method_field('DELETE') !!}
                                {!! csrf_field() !!}
                                <a href="{{route('editProduct',$product->id)}}" type="button" class="btn btn-primary btn-flat">Editar</a>
                                <button href="{{route('destroyProduct',$product->id)}}" type="submit" class="btn btn-danger btn-flat">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach  
                </tbody>
            </table>
            </div>
            </div>
            <div class="pull-right" style="margin: 0px;padding: 0px">
                    {!! $products->links() !!}
                </div>
            @endif
        </div>
        </div>
@endsection
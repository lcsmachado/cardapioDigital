@extends('adminlte::page')
@section('title','Lixeira de Produtos')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('notification'))
                <div class="alert alert-success">
                    <p>{{session()->get('notification')}}</p>
                </div>
            @endif
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
                            <td class="text-center">
                            <a href="{{route('editProduct',$product->id)}}" type="button" class="btn btn-primary btn-flat">Editar</a>
                            <a href="{{route('restoreProduct',$product->id)}}" type="button" class="btn btn-danger btn-flat">Restaurar</a>
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
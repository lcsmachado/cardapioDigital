@extends('adminlte::page')
@section('title','Cadastro de Categorias')
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
            <div class="panel-heading"><h4>Cadastro de Produtos</h4></div>
            <div class="panel-body">
            @if(isset($product))
                <form role="form" method="POST" action="{{route('updateProduct',$product->id)}}"enctype="multipart/form-data">
                    {!! method_field('PUT') !!}
                    @else
                        <form role="form" method="POST" action="{{route('storeProduct')}}"enctype="multipart/form-data">
                            @endif
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$product->name or old('name')}}" placeholder"{{$product->name or old('name')}}">
            </div>
            <div class="form-group">
                <label for="name">Ingredientes</label>
                <input type="text" class="form-control" id="ingredients" value="{{$product->ingredients or old('ingredients')}}"name="ingredients" placeholder"{{$product->ingredients or old('ingredients')}}">
            </div>
            <div class="form-group">
                <label for="name">Preço</label>
                <input type="text" class="form-control" id="price" name="price" value="{{$product->price or old('price')}}" placeholder"{{$product->price or old('price')}}">
            </div>
            <div class="form-group">
                    <label for="name">Categoria</label>
                    <select name="category_id" id="category_id">
                        <option value="">Selecione</option>
                        @foreach($categories->all() as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group">
                    <label for="name">Inserir Imagem</label>
                    <input type='file' id="primaryImage" name="primaryImage" accept="image/*" />
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
            </div>
            </div>
        </div>
    </div>
@endsection
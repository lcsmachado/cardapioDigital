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
            <div class="panel-heading"><h4>Cadastro de Categorias</h4></div>
            <div class="panel-body">
            @if(isset($category))
                <form role="form" method="POST" action="{{route('updateCategory',$category->id)}}" enctype="multipart/form-data">
                    {!! method_field('PUT') !!}
                    @else
                        <form role="form" method="POST" action="{{route('storeCategory')}}" enctype="multipart/form-data">
                            @endif
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$category->name or old('name')}} " placeholder"{{$category->name or old('name')}}">
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
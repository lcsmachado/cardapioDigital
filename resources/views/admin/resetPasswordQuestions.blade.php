@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>
        @if(session()->has('notification'))
        <div class="alert alert-danger">
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
        <!-- /.login-logo -->
        <div class="login-box-body">
                @if(isset($admin))
            <form action="{{route('confirmQuestions',$admin->email)}}" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                        <label for="name">Pergunta Secreta</label>
                        <input type="text" class="form-control" id="secret_question" value="{{$admin->secret_question or old('secret_question')}}" name="secret_question">
                </div>
                <div class="form-group">
                        <label for="name">Resposta Secreta</label>
                        <input type="text" class="form-control" id="secret_answer" name="secret_answer">
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit"
                                class="btn btn-primary btn-block btn-flat">Enviar</button>
                    </div>
                    <!-- /.col -->
                </div>
                @else
                    <div class="row">
                        <div class="col-xs-8">Email não Cadastrado
                        </div>
                    </div>
            </form>
            @endif
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    @yield('js')
@stop

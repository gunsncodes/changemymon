@extends('layouts.RegisterTemplate')

@if(Session::has('errorRegister'))
@section('RegisterMessage')
    <div class="alert alert-{{Session::get('class')}}">
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Cerrar</span>
        </button> <strong>{{Session::get('registerTitle')}}</strong>
        {{Session::get('registerMessage')}}
    </div>
@endsection
@endif

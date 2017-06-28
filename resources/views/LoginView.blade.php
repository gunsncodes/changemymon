@extends('layouts.LoginTemplate')

@if(Session::has('errorUser') || Session::has('showNotification'))
@section('LoginMessage')
    <div class="alert alert-{{Session::get('class')}}">
        <button type="button" class="close" data-dismiss="alert">
        <span aria-hidden="true">×</span>
        <span class="sr-only">Cerrar</span>
        </button> <strong>{{Session::get('loginTitle')}}</strong>
        {{Session::get('loginMessage')}}
    </div>
@endsection
@endif

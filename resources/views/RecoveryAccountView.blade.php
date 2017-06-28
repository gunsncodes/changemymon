@extends('layouts.RecoveryAccountTemplate')

@if(Session::has('showNotification'))
@section('RecoveryMessage')
    <div class="alert alert-{{Session::get('class')}}">
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Cerrar</span>
        </button>
        {{Session::get('recoveryMessage')}}
    </div>
@endsection

@endif

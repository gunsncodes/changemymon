@extends('layouts.prueba')

@push('scripts')
<script src="{{env('RUTA_JS')}}"></script>
@endpush

@section('title', 'cambiomidinero')
@section('nombre', 'cambiomidinero')

@section('sidebar')
    @parent
    <p>Esto se envía desde el child</p>
@endsection

@foreach($Usuarios as $usuario)
<?=$usuario."<br>"?>
@endforeach

@section('content')
    <p>Este es mi contenido...</p>
@endsection

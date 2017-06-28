<html>
<head>
    @stack('scripts')
    <title>@yield('title')</title>
</head>
<body>
@section('sidebar')
    Contenido inicial
@show

<div class="container">
    @yield('content')
</div>


</body>
</html>
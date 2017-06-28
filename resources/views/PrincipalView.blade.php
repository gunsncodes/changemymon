@extends('layouts.PrincipalTemplate')

@push('js_libraries')
        <!-- Bottom Scripts -->
<script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/TweenMax.min.js')}}"></script>
<script src="{{asset('js/resizeable.js')}}"></script>
<script src="{{asset('js/joinable.js')}}"></script>
<script src="{{asset('js/xenon-api.js')}}"></script>
<script src="{{asset('js/xenon-toggles.js')}}"></script>
<script src="{{asset('js/xenon-widgets.js')}}"></script>
<script src="{{asset('js/devexpress-web-14.1/js/globalize.min.js')}}"></script>
<script src="{{asset('js/devexpress-web-14.1/js/dx.chartjs.js')}}"></script>
<script src="{{asset('js/toastr/toastr.min.js')}}"></script>
<script src="{{asset('js/xenon-custom.js')}}"></script>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
@endpush

@push('css_libraries')
<link rel="stylesheet" href="{{asset('css/fonts/linecons/css/linecons.css')}}}}">
<link rel="stylesheet" href="{{asset('css/fonts/fontawesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('css/xenon-core.css')}}">
<link rel="stylesheet" href="{{asset('css/xenon-forms.css')}}">
<link rel="stylesheet" href="{{asset('css/xenon-components.css')}}">
<link rel="stylesheet" href="{{asset('css/xenon-skins.css')}}">
<link rel="stylesheet" href="{{asset('css/custom.css')}}">

@endpush

@push('menu')
@include('layouts.complements.MenuTemplate')
@endpush

@push('menuUp')
@include('layouts.complements.MenuUpTemplate')
@endpush

@push('menuTitleUp')
@include('layouts.complements.MenuTitleUpTemplate')
@endpush

@push('contentWeb')
 @include('layouts.contents.'.$content)
@endpush

@push('footer')
@include('layouts.complements.FooterTemplate')
@endpush
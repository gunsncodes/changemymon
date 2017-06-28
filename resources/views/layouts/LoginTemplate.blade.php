<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Inicio www.cambiomidinero.com"/>
    <meta name="author" content=""/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <title>Cambiomidinero - Login</title>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo:400,700,400italic">
    <link rel="stylesheet" href="css/fonts/linecons/css/linecons.css">
    <link rel="stylesheet" href="css/fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/xenon-core.css">
    <link rel="stylesheet" href="css/xenon-forms.css">
    <link rel="stylesheet" href="css/xenon-components.css">
    <link rel="stylesheet" href="css/xenon-skins.css">
    <link rel="stylesheet" href="css/custom.css">

    <script src="js/jquery-1.11.1.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    <!-- Bottom Scripts -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/TweenMax.min.js"></script>
    <script src="js/resizeable.js"></script>
    <script src="js/joinable.js"></script>
    <script src="js/xenon-api.js"></script>
    <script src="js/xenon-toggles.js"></script>
    <script src="js/jquery-validate/jquery.validate.min.js"></script>
    <script src="js/toastr/toastr.min.js"></script>


    <!-- JavaScripts initializations and stuff -->
    <script src="js/xenon-custom.js"></script>
    <script src="js/funciones_sistema.js"></script>

</head>
<body class="page-body login-page" style="padding-top: 0">

<script>//facebookLogin();</script>
<div class="login-container">

    <div class="row">

        <div class="col-sm-6">

            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    //$('body').before('<div class="page-loading-overlay"><div class="loader-2"></div></div>');
                    $('.btn').click(function () {
                        show_loading_bar(70); // Fill progress bar to 70% (just a given value)
                    })
                    // Revela el formulario
                    setTimeout(function () {
                        $(".fade-in-effect").addClass('in');
                    }, 1);
                });
            </script>

            <!-- Errors container -->
            <div class="errors-container">
            </div>

            <div class="alert-warning">
                @yield('LoginMessage')
            </div>

            <!-- Add class "fade-in-effect" for login form effect -->

            <form action="/loginUser" method="post" role="form" id="login" class="login-form fade-in-effect" style="margin: 0">
                {{ csrf_field() }}
                <div class="login-header">
                <!--   <a href="dashboard-1.html" class="logo">
                          <img src="lib/images/logo@2x.png" alt="" width="80" />
                           <span>Iniciar sesión</span>
                       </a>-->
                    <h3>Iniciar Sesión</h3>

                    <p>Inicia sesión para acceder a la aplicación</p>
                </div>

                <div class="errors-container">@yield('UsernameMessage')</div>
                <div class="form-group">
                    <label class="control-label" for="username">Usuario</label>
                    <input type="text" class="form-control input-dark" name="username" id="username"
                           autocomplete="off"/>
                </div>

                <div class="form-group">
                    <label class="control-label" for="passwd">Contraseña</label>
                    <input type="password" class="form-control input-dark" name="passwd" id="passwd"
                           autocomplete="off"/>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-secondary btn-dark  btn-block text-left">
                        <i class="fa-lock"></i>
                        Iniciar sesión
                    </button>
                </div>

                <div class="login-footer" style="margin:0">
                    <div class="col-sm-12">
                        <a href="recovery" class="col-sm-6" style="text-align: right;">¿Olvidaste tu contraseña?</a>
                        <a href="register" id="btnRegistro" class="col-sm-6" style="text-align: right;">Registrate</a>
                    </div>
                    <!--<div class="info-links">
                        <a href="#">ToS</a> -
                        <a href="#">Privacy Policy</a>
                    </div>-->
                </div>

            </form>

            <!-- External login -->

            <div class="external-login" >
                <a style="cursor: pointer; margin-top: 2%" onclick="iniciarSesionFacebook()" class="facebook">
                    <i class="fa-facebook"></i>
                    Iniciar sesión con Facebook
                </a>



            </div>

        </div>

    </div>

</div>
<!--<a href="javascript:;" onclick="jQuery('#modal-4').modal('show');" class="btn btn-primary btn-single btn-sm">Show Me</a>-->
<div class="modal fade" id="modal-4" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" style="color: black">Código de activación</h4>
            </div>
            <form method="post" role="form" id="activateAccount" class="login-form fade-in-effect" style="margin: 0">
                <div class="modal-body" style="color: black">
                    Ingresa el código de activación que te fue enviado con anterioridad

                    <div class="form-group">
                        <label class="control-label" for="codeActivation">Codigo</label>
                        <input type="text" class="form-control" style="background-color: honeydew" name="codeActivation" id="codeActivation"
                               autocomplete="off"/>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="col-sm-12">
                        <a href="recovery" class="col-sm-9" style="text-align: left;">¿Aún no lo tienes?</a>
                        <button type="submit" class="btn btn-info col-sm-3">Continuar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
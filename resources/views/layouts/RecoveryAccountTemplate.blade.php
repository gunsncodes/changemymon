<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Inicio www.cambiomidinero.com"/>
    <meta name="author" content=""/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <title>Cambiomidinero - Recuperación</title>

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

<script></script>
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

            <div class="alert-warning">

                @yield('RecoveryMessage')
            </div>


            <!-- Add class "fade-in-effect" for login form effect -->
            <form action="/recoveryAccount" method="post" role="form" id="recovery" class="login-form fade-in-effect" style="margin: 0">
                {{ csrf_field() }}
                <div class="login-header">
                <!--   <a href="dashboard-1.html" class="logo">
                          <img src="lib/images/logo@2x.png" alt="" width="80" />
                           <span>Iniciar sesión</span>
                       </a>-->
                    <h3>Recupera tus datos de acceso</h3>

                    <p>Solicita tu correo con datos de aceso o correo de activación</p>
                </div>


                <div class="form-group">
                    <label class="control-label" for="correo">Ingrese su email</label>
                    <input type="text" class="form-control input-dark" name="correo" id="correo"
                           autocomplete="off"/>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-secondary btn-dark  btn-block text-left">
                        <i class="fa-lock"></i>
                        Enviar correo
                    </button>
                </div>

                <div class="login-footer" style="margin:0">
                    <div class="col-sm-12">
                        <a href="login" class="col-sm-6" style="text-align: left;">¿Ya estas registrado?</a>
                        <a href="register" class="col-sm-6" style="text-align: right;">Registrate</a>
                    </div>
                    <!--<div class="info-links">
                        <a href="#">ToS</a> -
                        <a href="#">Privacy Policy</a>
                    </div>-->
                </div>

            </form>

            <!-- External login -->


        </div>

    </div>

</div>


</body>
</html>
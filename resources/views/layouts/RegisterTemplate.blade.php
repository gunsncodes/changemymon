<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Inicio www.cambiomidinero.com"/>
    <meta name="author" content=""/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <title>Cambiomidinero - Registro</title>

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
    <script src="js/datepicker/bootstrap-datepicker.js"></script>



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
                @yield('RegisterMessage')
            </div>

            <!-- Add class "fade-in-effect" for login form effect -->
            <form action="registerUser" method="post" role="form" id="register" class="login-form fade-in-effect">
                {{ csrf_field() }}
                <div class="login-header">
                <!--   <a href="dashboard-1.html" class="logo">
                          <img src="lib/images/logo@2x.png" alt="" width="80" />
                           <span>Iniciar sesión</span>
                       </a>-->
                    <h3>Regístrate</h3>

                    <p>Regísrate para luego iniciar sesión y acceder a la aplicación</p>
                </div>


                <div class="form-group">
                    <label class="control-label" for="nombre">Nombre</label>
                    <input class="form-control input-dark" type="text" name="nombre" id="nombre"
                           style="margin-bottom: 5px" autocomplete="off">
                </div>

                <div class="form-group">
                    <label class="control-label" for="apellido">Apellido</label>
                    <input class="form-control input-dark" type="text" name="apellido" id="apellido"
                           autocomplete="off">
                </div>

                <div class="form-group">
                    <label class="control-label" for="correo">Correo</label>
                    <input class="form-control input-dark" type="email" name="correo" id="correo" autocomplete="off">
                </div>

                <div class="form-group">
                    <label class="control-label" for="usuario">Usuario</label>
                    <input class="form-control input-dark" type="text" name="usuario" id="usuario"
                          autocomplete="off">
                </div>

                <div class="form-group">
                    <label class="control-label" for="password">Contraseña</label>
                    <input class="form-control input-dark" type="password" name="password" id="password"
                           autocomplete="off">
                </div>

                <div class="form-group">
                    <label class="control-label" for="repitepassword">Repita contraseña</label>
                    <input class="form-control input-dark" type="password" name="repitepassword" id="repitepassword"
                           autocomplete="off">
                </div>

                <div class="form-group">
                    <!-- <label class="control-label" for="fechaNacimiento">Fecha de nacimiento</label>-->
                    <!--  <input id="fechaNacimiento" name="fechaNacimiento" class="form-control input-dark"
                             data-end-date="-18y" type="text" autocomplete="off">-->
                    <div class="row" style="text-align: center;">
                        <select id="diaNac" name="diaNac" class="col-sm-4 input-dark  form-control" style="width: 30%">
                            @for($a = 1; $a <= 31; $a++)
                                <option value="{{$a}}">{{$a}}</option>
                            @endfor
                        </select>

                        <select id="mesNac" name="mesNac" class="col-sm-4 input-dark form-control" style="width: 30%;">
                            <?
                                $mes = array(1=>'Enero',
                                             2=>'Febrero',
                                             3=>'Marzo',
                                             4=>'Abril',
                                             5=>'Mayo',
                                             6=>'Junio',
                                             7=>'Julio',
                                             8=>'Agosto',
                                             9=>'Septiembre',
                                             10=>'Octubre',
                                             11=>'Noviembre',
                                             12=>'Diciembre');
                            ?>
                            @for($b = 1; $b <= 12; $b++)
                                <option value="{{$b}}">{{$mes[$b]}}</option>
                            @endfor
                        </select>

                        <select id="anoNac" name="anoNac" class="col-sm-4 input-dark form-control" style="width: 30%">
                            <?$fecha = date('Y');?>
                            @for ($c = 0; $c < 111; $c++)
                            <?$year = $fecha - $c;?>
                            <option value="<?= $year ?>"><?= $year ?></option>
                            @endfor
                        </select>

                    </div>

                    @yield('error_mensaje')


                </div>

                <div class="login-footer" style="margin: 0">
                    <div class="col-sm-12">
                        <a href="login" class="col-sm-6" style="text-align: left;">¿Ya estas registrado?</a>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 16%;">
                    <button class="btn btn-secondary btn-dark" style="text-align: center">
                        Registrar
                    </button>
                </div>


            </form>

            <!-- External login -->
        </div>

    </div>

    <div class="modal fade" id="modal-4" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" style="color: black">Código de activación</h4>
                </div>
                <form method="post" role="form" id="activateAccount" class="login-form fade-in-effect" style="margin: 0">
                    <div class="modal-body" style="color: black">
                        Ingresa el código de activación que te hemos enviado a tu correo.

                        <div class="form-group">
                            <label class="control-label" for="codeActivation">Codigo</label>
                            <input type="text" class="form-control" style="background-color: honeydew" name="codeActivation" id="codeActivation"
                                   autocomplete="off"/>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12">
                            <a href="administrador.php?go=recuperacion" class="col-sm-9" style="text-align: left;">¿Aún no lo tienes?</a>
                            <button type="submit" class="btn btn-info col-sm-3">Continuar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>



</body>
</html>
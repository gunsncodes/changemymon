<?$user = $object;
$sexoUser = "";
if ($user->usuario_sexo == 'M') {
    $sexoUser = "Masculino";
} else if ($user->usuario_sexo = 'F') {
    $sexoUser = "Femenino";
}
?>
<div>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#infoPersonal">Información personal</a></li>
        <li><a data-toggle="tab" href="#bancos">Bancos</a></li>
        <li><a data-toggle="tab" href="#calificacion">Calificación</a></li>
    </ul>
    <div class="tab-content" style="width: 95%;">
        <div id="infoPersonal" class="perfilUsuario tab-pane fade in active">
            <div class="row">
                <label class="col-md-2">Nombre:</label>
                <label class="col-md-4">{{$user->usuario_nombre}}</label>
            </div>
            <div class="row">
                <label class="col-md-2">Apellido:</label>
                <label class="col-md-4">{{$user->usuario_apellido}}</label>
            </div>
            <div class="row">
                <label class="col-md-2">RUT:</label>
                <label class="col-md-4">{{$user->usuario_cedula}}</label>
            </div>
            <div class="row">
                <label class="col-md-2">Email:</label>
                <label class="col-md-4">{{$user->usuario_email}}</label>
            </div>
            <div class="row">
                <label class="col-md-2">Número de contacto:</label>
                <label class="col-md-4">{{$user->usuario_telefonocelular!='' || $user->usuario_telefonofijo?$user->usuario_telefonocelular." / ".$user->usuario_telefonofijo:''}}</label>
            </div>
            <div class="row">
                <label class="col-md-2">País:</label>
                <label class="col-md-4">{{$user->pais_nombre}}</label>
            </div>
            <div class="row">
                <label class="col-md-2">Region:</label>
                <label class="col-md-4"></label>
            </div>
            <div class="row">
                <label class="col-md-2">Provincia:</label>
                <label class="col-md-4"></label>
            </div>
            <div class="row">
                <label class="col-md-2">Comuna:</label>
                <label class="col-md-4"></label>
            </div>
            <div class="row">
                <label class="col-md-2">Dirección:</label>
                <label class="col-md-4">{{$user->usuario_direccion}}</label>
            </div>
            <div class="row">
                <label class="col-md-2">Fecha de nacimiento:</label>
                <label class="col-md-4">{{Date('d-m-Y', strtotime($user->usuario_fechanacimiento))}}</label>
            </div>
            <div class="row">
                <label class="col-md-2">Sexo:</label>
                <label class="col-md-4">{{$sexoUser}}</label>
            </div>
            <div class="row" style="text-align: center;">
                <button class="btn btn-secondary" data-toggle="modal" data-target="#modifyUserInformation">Actualizar
                    datos
                </button>
            </div>
        </div>
        <div id="bancos" class="tab-pane fade">
        </div>
        <div id="calificacion" class="tab-pane fade">
        </div>
    </div>
    <!--////////////////// Contenido de modal //////////////////-->
    <div id="modifyUserInformation" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Información personal</h4>
                </div>
                <div class="modal-body" style="height: auto" id="informationUser">
                    <div class="panel panel-default" style="padding-bottom: 0; margin-bottom: 0">
                        <div style="text-align:  center" class="panel-body">
                            <form action="myprofile/update" method="post" role="form" class="form-horizontal" role="form">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="nombre">Nombre</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nombre" id="nombre"
                                               value="{{$user->usuario_nombre}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="apellido">Apellido</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="apellido" id="apellido"
                                               value="{{$user->usuario_apellido}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="run">RUT</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="rut" id="rut"
                                               value="{{$user->usuario_cedula}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="email">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="email" id="email" disabled
                                               value="{{$user->usuario_email}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="nMovil">Número móvil</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nMovil" id="nMovil"
                                               value="{{$user->usuario_telefonocelular}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="nFijo">Número fijo</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nFijo" id="nFijo"
                                               value="{{$user->usuario_telefonofijo}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="pais">País</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="pais" id="pais">
                                            <option value="">- Seleccione -</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="region">Región</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="region" id="region">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="provincia">Provincia</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="provincia" id="provincia">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="comuna">Comuna</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="comuna" id="comuna">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="direccion">Dirección</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="direccion" id="direccion"
                                               value="{{$user->usuario_direccion}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="fNacimiento">Fecha de
                                        nacimiento</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="fNacimiento" id="fNacimiento"
                                               value="{{Date('d-m-Y', strtotime($user->usuario_fechanacimiento))}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="sexo">Sexo</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="sexo" id="sexo">
                                            <option value="">- Seleccione -</option>
                                            <option value="M">
                                                Masculino
                                            </option>
                                            <option value="F">
                                                Femenino
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" name="guardar" id="guardar" style="margin-top: 25px"
                                            class="btn btn-primary">Guardar
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
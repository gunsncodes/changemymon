<?

namespace cambiomidinero\Http\Controllers;

use cambiomidinero\Model\Acceso;
use cambiomidinero\Model\StringActivacionCuenta;
use cambiomidinero\Model\Usuario;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    const USUARIO_SIN_ACTIVAR = 0;
    const PERFIL_COMPRADOR_ESTANDAR = 1;

    const REGISTER_TEMPLATE = 1;
    const EMAIL_EXIST_MESSAGE = "El email ingresado se encuentra registrado. Intente recuperar su clave si no logra recordarla.";
    const USER_EXIST_MESSAGE = "El usuario ingresado se encuentra en uso. Por favor, intente con otro nombre de usuario";
    const SUCCESS_MESSAGE = "El registro fue exitoso. Por favor, verifique su correo para confirmar el proceso.";
    const ERROR_MESSAGE = "El usuario no pudo ser creado. Por favor, intente mas tarde.";

    const ERROR_TITLE = 'Error: ';
    const WARNING_TITLE = 'Alerta: ';
    const SUCCESS_TITLE = 'Alerta: ';

    const CHILE = 38;

    public function home()
    {
        return view('RegisterView');
    }

    public function registerUser(Request $request)
    {
        if ($request->attributes->get('statusValidationParameters')) {
            $usuario = null;
            $acceso = null;
            $stringActivacionCuenta = null;
            $showAlert = null;
            $alertTitle = null;
            $functionController = new FunctionController();
            try {
                $usuario = new Usuario;
                $usuario->setAttribute('usuario_nombre', $functionController->formatStringUperCase($request->nombre));
                $usuario->setAttribute('usuario_apellido', $functionController->formatStringUperCase($request->apellido));
                $usuario->setAttribute('usuario_email', $request->correo);
                $usuario->setAttribute('usuario_fechanacimiento', $request->anoNac . '-' . $request->mesNac . '-' . $request->diaNac);
                $usuario->setAttribute('usuario_fechaactualizacion', Date('Y-m-d H:i:s'));
                $usuario->setAttribute('pais_id', self::CHILE);
                $usuario->save();

                $acceso = new Acceso();
                $acceso->setAttribute('usuario_id', $usuario->getAttribute('usuario_id'));
                $acceso->setAttribute('acceso_usuario', strtolower($request->usuario));
                $acceso->setAttribute('acceso_clave', $request->password);
                $acceso->setAttribute('acceso_fecharegistro', Date('Y-m-d H:i:s'));
                $acceso->setAttribute('acceso_estado', $this::USUARIO_SIN_ACTIVAR);
                $acceso->setAttribute('perfil_id', $this::PERFIL_COMPRADOR_ESTANDAR);
                $acceso->save();

                $securityController = new SecurityController();
                $stringActivacionCuenta = new StringActivacionCuenta();
                $existStream = true;
                while ($existStream) {
                    $stream = $securityController->generateStream();
                    $existStream = $securityController->validateStream($stream);
                }

                $stringActivacionCuenta->setAttribute('usuario_id', $usuario->getAttribute('usuario_id'));
                $stringActivacionCuenta->setAttribute('stringactivacioncuenta_codigo', $stream);
                $stringActivacionCuenta->setAttribute('stringactivacioncuenta_estado', self::USUARIO_SIN_ACTIVAR);
                $stringActivacionCuenta->setAttribute('stringactivacioncuenta_fechacreacion', Date('Y-m-d H:i:s'));
                $stringActivacionCuenta->save();

                $mailingController = new MailingController;
                $mailingController->setSecurityController($securityController);
                $error = $mailingController->sendTemplate($usuario->getAttribute('usuario_email'), self::REGISTER_TEMPLATE);
                if ($error) {
                    $usuario->delete();
                    $acceso->delete();
                    $stringActivacionCuenta->delete();

                    $showAlert = true;
                    $alertTitle = self::ERROR_TITLE;
                    $message = self::ERROR_MESSAGE;
                    $styleClass = "danger";
                    ## No se registra el error en esta línea, ya que se realizó en el método @enviarCorreo
                } else {
                    $showAlert = true;
                    $alertTitle = self::SUCCESS_TITLE;
                    $message = self::SUCCESS_MESSAGE;
                    $styleClass = "success";
                }

            } catch (QueryException $e) {
                if ($usuario) {
                    $usuario->delete();
                    if ($acceso) {
                        $acceso->delete();
                        if ($stringActivacionCuenta) {
                            $stringActivacionCuenta->delete();
                        }
                        $message = self::USER_EXIST_MESSAGE;
                    } else {
                        $message = self::EMAIL_EXIST_MESSAGE;
                    }
                    $showAlert = true;
                    $alertTitle = self::WARNING_TITLE;
                    $styleClass = "warning";
                } else {
                    $showAlert = true;
                    $alertTitle = self::ERROR_TITLE;
                    $message = self::ERROR_MESSAGE;
                    $styleClass = "error";
                    $errorController = new ErrorController();
                    $errorController->registerError($e, __LINE__);
                }
            }
        } else {
            $message = $request->attributes->get('middlewareMessage');
            $styleClass = "danger";
            $alertTitle = self::ERROR_TITLE;
            $showAlert = true;
        }
        $request->session()->flash('errorRegister', $showAlert);
        $request->session()->flash('registerTitle', $alertTitle);
        $request->session()->flash('registerMessage', $message);
        $request->session()->flash('class', $styleClass);
        return Redirect::back();

    }
}

?>
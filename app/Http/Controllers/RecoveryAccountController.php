<?
namespace cambiomidinero\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RecoveryAccountController extends Controller {

    const RECOVERYACCOUNT_TEMPLATE = 2;

    const SUCCESS_RECOVERY_MESSAGE = 'Los datos de acceso fueron enviados exitosamente a su correo';
    const ERROR_UNEXPECTED_RECOVERY_MESSAGE = 'El correo no ha podido ser enviado. Por favor, intente en breves minutos';
    const UNEXISTENT_USER = 'El correo ingresado no se encuentra ingresado en nuestro sistema';
    const ERROR_FORMAT_EMAIL = 'El email ingresado no es correcto.';
    
    public function home(){
        return view('RecoveryAccountView');
    }

    public function recoverUserAccount(Request $request){
        if ($request->attributes->get('statusValidationParameters')) {
            $email = $request->get('correo');
            $usuarioController = new UsuarioController();
            $userInfo = $usuarioController->findUserByEmail($email);
            if($userInfo){
                $mailingController = new MailingController();
                $mailingController->setUserId($userInfo->usuario_id);
                if($mailingController->sendTemplate($email,self::RECOVERYACCOUNT_TEMPLATE) == env('SUCCESS_STATUS')){
                    $recoveryMessage = self::SUCCESS_RECOVERY_MESSAGE;
                    $classStyle = 'success';
                }else{
                    $recoveryMessage = self::ERROR_UNEXPECTED_RECOVERY_MESSAGE;
                    $classStyle = 'danger';
                    $errorController = new ErrorController();
                    $errorController->registerError('Error al enviar correo.', __LINE__);
                }
            }else{
                $recoveryMessage = self::UNEXISTENT_USER;
                $classStyle = 'warning';
            }
        }else{
            $recoveryMessage = self::ERROR_FORMAT_EMAIL;
            $classStyle = 'danger';
        }

        $request->session()->flash('showNotification', true);
        $request->session()->flash('recoveryMessage', $recoveryMessage);
        $request->session()->flash('class', $classStyle);
        return Redirect::back();
    }


}
?>
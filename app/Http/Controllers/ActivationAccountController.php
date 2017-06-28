<?

namespace cambiomidinero\Http\Controllers;

use cambiomidinero\Model\Acceso;
use cambiomidinero\Model\StringActivacionCuenta;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ActivationAccountController extends Controller
{
    const ERROR_STREAM_VALIDATION = "El código de activación no es correcto.";
    const ERROR_SYSTEM_VALIDATION = "El stream recibido no cumple con los parámetros correspondientes. Stream: ";
    const SUCCESS_ACTIVATION_MESSAGE = "Su cuenta ha sido activada de manera exitosa.";
    const ERROR_ACTIVATION_MESSAGE = "Ha ocurrido un error al momento de activar su cuenta. Por favor, intente en breves minutos.";
    const USED_ACTIVATION_MESSAGE = "Esta cuenta ya ha sido activada anteriormente.";

    const UNACTIVATED_ACCOUNT = 0;
    const ACTIVATED_ACCOUNT = 1;
        
    public function validateActivationStream(Request $request, $stream)
    {
        $errorActivation = null;
        $activationTitle = null;
        $activationMessage = null;
        $classStyle = null;
        if ($request->attributes->get('statusValidationParameters')) {
            $stringActivationObject = $this->validateStream($stream);
            if (sizeof($stringActivationObject) > 0) {
                $stringActivationModel = new StringActivacionCuenta();
                $stringActivationModel->stringactivacioncuenta_id =
                    $stringActivationObject[0]->stringactivacioncuenta_id;
                if ($this->activateAccount($stringActivationModel)) {
                    $activationTitle = '';
                    $activationMessage = self::SUCCESS_ACTIVATION_MESSAGE;
                    $classStyle = 'success';
                }else{
                    $activationTitle = 'Error: ';
                    $activationMessage = self::ERROR_ACTIVATION_MESSAGE;
                    $classStyle = 'danger';
                }
            }else{
                $activationTitle = 'Alerta: ';
                $activationMessage = self::USED_ACTIVATION_MESSAGE;
                $classStyle = 'warning';
            }
        } else {
            $activationTitle = 'Error: ';
            $activationMessage = self::ERROR_STREAM_VALIDATION;
            $classStyle = 'danger';
            $errorController = new ErrorController();
            $errorController->registerError(self::ERROR_SYSTEM_VALIDATION . $stream, __LINE__);
        }
        $request->session()->flash('showNotification', true);
        $request->session()->flash('loginTitle', $activationTitle);
        $request->session()->flash('loginMessage', $activationMessage);
        $request->session()->flash('class', $classStyle);

        return Redirect::route('login');
    }

    private function validateStream($stream)
    {
        $stringActivacionCuenta = StringActivacionCuenta::
        where('stringactivacioncuenta_codigo', $stream)
            ->where('stringactivacioncuenta_estado', self::UNACTIVATED_ACCOUNT)
            ->take(1)
            ->get();

        return $stringActivacionCuenta;
    }

    private function activateAccount(StringActivacionCuenta $stringActivacionCuentaTemp)
    {
        try {
            $stringActivacioncuentaModel = StringActivacionCuenta::
            where('stringactivacioncuenta_id', $stringActivacionCuentaTemp->stringactivacioncuenta_id)
            ->first();

            $stringActivacioncuentaModel->stringactivacioncuenta_estado = self::ACTIVATED_ACCOUNT;
            $stringActivacioncuentaModel->stringactivacioncuenta_fechaactivacion = Date('Y-m-d H:i:s');
            $stringActivacioncuentaModel->save();

            $accesoModel = Acceso::where('usuario_id', $stringActivacioncuentaModel->usuario_id)
               ->first();
            $accesoModel->acceso_estado = self::ACTIVATED_ACCOUNT;
            $accesoModel->save();

            return true;
        } catch (QueryException $e) {
            #DB::rollback();
            $errorController = new ErrorController();
            $errorController->
            registerError($e->getMessage(). ". usuario_id:".$stringActivacionCuentaTemp->usuario_id, __LINE__);
        }
        return false;
    }
}

?>
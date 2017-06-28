<?
namespace cambiomidinero\Http\Controllers;

use cambiomidinero\Model\ErrorSistema;
use Exception;
use Illuminate\Support\Facades\App;


class ErrorController extends Controller
{

    const ERROR_SIN_LEER = 0;
    const LIST_MAIL_ERROR = array('caraque@cambiomidinero.com');

    /**
     * @param $e
     * Es la exceptión completa (Object) O un String con el mensaje
     * @param $line 
     * __LINE__
     * Es la línea del error tomada por PHP
     */
    public function registerError($e, $line)
    {
        $mensaje = gettype($e) == "string"? $e : (Object) $e->getMessage();
        $error = new ErrorSistema();
        $error->setAttribute('errorsistema_mensaje', $mensaje);
        $error->setAttribute('errorsistema_archivo', $this->generateCallTrace());
        $error->setAttribute('errorsistema_lineareferencia', $line);
        $error->setAttribute('errorsistema_fecha', Date('Y-m-d H:i:s'));
        $error->setAttribute('errorsistema_estado', self::ERROR_SIN_LEER);
        $error->save();

    }

    private function generateCallTrace()
    {
        $e = new Exception();
        $trace = explode("\n", $e->getTraceAsString());
        // reverse array to make steps line up chronologically
        $trace = array_reverse($trace);
        array_shift($trace); // remove {main}
        array_pop($trace); // remove call to this method
        $length = count($trace);
        $trace = array_reverse($trace);
        $result = array();

        for ($i = 0; $i < 1; $i++)
        {
            $result[] = ($i + 1)  . ')' . substr($trace[$i], strpos($trace[$i], ' ')); // replace '#someNum' with '$i)', set the right ordering
        }

        return "\t" . implode("\n\t", $result);
    }

}

?>
<?
namespace cambiomidinero\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SecurityController extends Controller
{
    
    private $stream;

    
    function generateStream()
    {
        $length = env('STREAM_ACTIVATION_LENGTH');
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $this->setStream($randomString);
        return $randomString;
    }
    
    function validateStream($stream){
        $existStream = DB::table('stringactivacioncuenta')
                                  ->where('stringactivacioncuenta_codigo', $stream)->count();
        return $existStream;
    }

    /**
     * @return mixed
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * @param mixed $stream
     */
    public function setStream($stream)
    {
        $this->stream = $stream;
    }
}

?>
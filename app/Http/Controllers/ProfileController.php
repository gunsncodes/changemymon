<?
namespace cambiomidinero\Http\Controllers;

use cambiomidinero\Model\Usuario;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{

    public function update(Request $request){
        $user = new Usuario::find("");
        $user->setAttribute('usuario_id',Session::get('userId'));
        $user->setAttribute('usuario_cedula', $request->rut);
        $user->update();
        return Redirect::back();
    }

}

?>
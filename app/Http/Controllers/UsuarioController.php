<?

namespace cambiomidinero\Http\Controllers;

use cambiomidinero\Model\Usuario;

class UsuarioController extends Controller
{

    public function findUserByEmail($email){
        $userId = Usuario::where('usuario_email', $email)->select('usuario_id')->first();
        return $userId;
    }

    public function getUserAccessByUserId($userId){
        $accessUserInformation = Usuario::where('usuario.usuario_id',$userId)
            ->join('acceso', 'usuario.usuario_id','=','acceso.usuario_id')
            ->first();
        return $accessUserInformation;
    }

    public function getUserInformationByUserId($userId){
        $userInformation = Usuario::where('usuario.usuario_id',$userId)
            ->join('pais','pais.pais_id', '=','usuario.pais_id')
            ->leftjoin('region','region.region_id', '=','usuario.region_id')
            ->first();
        return $userInformation;
    }
    
}

?>
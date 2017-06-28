<?
namespace cambiomidinero\Http\Controllers;

use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function getContentView(Request $request){
        $path = $request->getPathInfo();
        $userId = $request->attributes->get('userId');
        $content = '404';
        $explode =  explode('/',$path);
        $username = $explode[1];
        $route = $explode[2];
        switch ($route){
            case 'home':
                $content = 'Dashboard';
                $data = '';
                break;
            case 'myprofile':
                $content = 'MyProfile';
                $userController = new UsuarioController();
                $data = $userController->getUserInformationByUserId($userId);
                break;
        }
        return $response = array('content'=>$content, 'data'=>$data);
    }
}

?>
<?
namespace cambiomidinero\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PrincipalController extends Controller
{

    public function home(Request $request)
    {
        $userId = session('userId');
        if ($userId) {
            $menu1User = $this->getMenu1User($userId);
            $menuUser = null;
            $request->attributes->add(['userId' => $userId]);
            $content = $this->getContentView($request);

            $functionController = new FunctionController();
            foreach ($menu1User as $menu1) {
                $menu2User = $this->getMenu2User($menu1->perfil_id, $menu1->menu1_id);
                $menu1->menu2User = $menu2User;
                $menuUser[] = $menu1;
            }

            $usuarioController = new UsuarioController();
            $userInfo = $usuarioController->getUserAccessByUserId($userId);
            $nameUser = $functionController->formatNameUser($userInfo->usuario_nombre, $userInfo->usuario_apellido, 2);

            $data = array('menu1User' => $menuUser,
                          'nameUser' => $nameUser,
                          'content' => $content['content'],
                          'object' => $content['data']);
            return view('PrincipalView', $data);
        } else {
            return Redirect::route('login');
        }
    }

    private function getMenu1User($userId)
    {

        $usuarioController = new UsuarioController();
        $userInfo = $usuarioController->getUserAccessByUserId($userId);
        $menu1User = DB::table('menu1')
            ->where('perfil_id', $userInfo->perfil_id)->get();
        return $menu1User;
    }

    private function getMenu2User($perfilId, $menu1Id)
    {
        $menu1User = DB::table('menu2')
            ->where('perfil_id', $perfilId)
            ->where('menu1_id', $menu1Id)
            ->get();
        return $menu1User;
    }

    private function getContentView(Request $request){
        $contentController = new ContentController();
        return $contentController ->getContentView($request);
    }

}

?>
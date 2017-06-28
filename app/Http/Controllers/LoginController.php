<?php
namespace cambiomidinero\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller {

    const UNSUCCESS_LOGIN_MESSAGE = "Los datos ingresados no son correctos.";

    public function home(){
        return view('LoginView');
    }

    public function login(Request $request){
        if($request->attributes->get('statusValidationParameters')) {
            $username = $request->username;
            $password = $request->passwd;
            $userAccess = $this->validateUserLogin($username, $password);
            if (!sizeof($userAccess) > 0) {
                $request->session()->flash('errorUser', true);
                $request->session()->flash('loginTitle', 'Datos incorrectos:');
                $request->session()->flash('loginMessage', self::UNSUCCESS_LOGIN_MESSAGE);
                $request->session()->flash('class', 'warning');
                return Redirect::route('login');
            } else {
                session(['userId'=>$userAccess->usuario_id]);
                session(['username'=>$userAccess->acceso_usuario]);
                $data = array('username'=>$username);
                return Redirect::route('home', $data);
            }
        }else{
            $request->session()->flash('errorUser', true);
            $request->session()->flash('loginTitle', 'Error:');
            $request->session()->flash('loginMessage', $request->attributes->get('middlewareMessage'));
            $request->session()->flash('class', 'danger');
            #return view('LoginView');
            return Redirect::back();
        }
    }

    private function validateUserLogin($user, $password){
       $userAccess = DB::table('acceso')
            ->where('acceso_usuario', $user)->where('acceso_clave',$password)->first();

        return $userAccess;
    }
}
?>
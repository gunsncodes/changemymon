<?php

namespace cambiomidinero\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Session;

class FormularyMiddleware
{

    const PATH_LOGIN = '/loginUser';
    const PATH_REGISTER = '/registerUser';
    const PATH_ACTIVATION_ACCOUNT = '/activationAccount';
    const PATH_RECOVERY_ACCOUNT = '/recoveryAccount';
    const PATH_UPDATE_MYPROFILE = '/myprofile/update';

    const USERNAME_PASSWORD_EMPTY = 'Ingrese su usuario y contraseña para acceder al sitio web';
    const REGISTER_FORM_EMPTY = 'Debe llenar todos los campos del formulario para poder ser registrado';

    const NAME_USER_MESSAGE = 'El nombre ingresado posee caracteres no válidos';
    const LASTNAME_USER_MESSAGE = 'El apellido ingresado posee caracteres no válidos';
    const EMAIL_USER_MESSAGE = 'El email ingresado posee un formato incorrecto';
    const USERNAME_USER_MESSAGE = 'El nombre de usuario ingresado posee un formato incorrecto';
    const PASSWORD_USER_MESSAGE = 'Las contraseñas ingresadas no son similares. Por favor, repita las contraseñas';
    const DATE_USER_MESSAGE = 'La fecha de nacimiento ingresada no es válida';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->input('_token') == Session::token()) {
            $isError = null;
            if ($request->getPathInfo() == self::PATH_LOGIN) {
                $username = $request->get('username');
                $password = $request->get('passwd');
                if ($username && $password) {
                    $isError = $this->validateLoginForm($request);
                } else {
                    $isError = true;
                    $request->attributes->add(['middlewareMessage' => self::USERNAME_PASSWORD_EMPTY]);
                }
            } else if ($request->getPathInfo() == self::PATH_REGISTER) {
                $name = $request->get('nombre');
                $lastName = $request->get('apellido');
                $email = $request->get('correo');
                $username = $request->get('usuario');
                $password = $request->get('password');
                $repeatPassword = $request->get('repitepassword');
                $diaNac = $request->get('diaNac');
                $mesNac = $request->get('mesNac');
                $anoNac = $request->get('anoNac');
                if ($name && $lastName && $email && $username && $password && $repeatPassword
                && $diaNac && $mesNac && $anoNac) {
                    $responseT = $this->validateRegisterForm($request);
                    if ($responseT['error']) {
                        $request->attributes->add(['middlewareMessage' => $responseT['message']]);
                        $isError = true;
                    }
                } else {
                    $isError = true;
                    $request->attributes->add(['middlewareMessage' => self::REGISTER_FORM_EMPTY]);
                }
            } else if($request->getPathInfo() == self::PATH_RECOVERY_ACCOUNT) {
                $email = $request->get('correo');
                if($email){
                    if(!$this->validateEmailFormat($email)){
                        $request->attributes->add(['middlewareMessage' => self::EMAIL_USER_MESSAGE]);
                        $isError = true; 
                    }                     
                }
            }else if($request->getPathInfo() == "/".Session::get('username').self::PATH_UPDATE_MYPROFILE){
                //Validar formulario
            }
            /*Indica si pasa o no la prueba. Si Response es true, no pasó la prueba de validación
             * desde el Middleware
             */

            if ($isError) {
                $request->attributes->add(['statusValidationParameters' => false]);
            } else {
                $request->attributes->add(['statusValidationParameters' => true]);
            }


            return $next($request);
        } else {
            #Retornar a una vista de error. No se recibió Token
            return redirect()->guest('login');
        }

    }

    /*
     * @function validateRegisterForm
     * @return Retorna 1 si es error, null si está correcto
     */
    private function validateLoginForm(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('passwd');

        if ($username) {
            $status = $this->validateString(1, $username);
        } else {
            $status = 1;
        }

        return $status;
    }


    private function validateRegisterForm(Request $request)
    {
        $name = $request->get('nombre');
        $lastName = $request->get('apellido');
        $email = $request->get('correo');
        $username = $request->get('usuario');
        $password = $request->get('password');
        $repeatPassword = $request->get('repitepassword');
        $diaNac = $request->get('diaNac');
        $mesNac = $request->get('mesNac');
        $anoNac = $request->get('anoNac');

        $bucle = true;
        $error = false;
        $message = null;
        while ($bucle) {
            $statusName = $this->validateString(2, $name);
            if ($statusName) {
                $error = true;
                $message = self::NAME_USER_MESSAGE;
                break;
            }
            $statusLastName = $this->validateString(2, $lastName);
            if ($statusLastName) {
                $error = true;
                $message = self::LASTNAME_USER_MESSAGE;
                break;
            }
            $statusEmail = $this->validateEmailFormat($email);
            if (!$statusEmail) {
                $error = true;
                $message = self::EMAIL_USER_MESSAGE;
                break;
            }
            $statusUsername = $this->validateString(1, $username);
            if ($statusUsername) {
                $error = true;
                $message = self::USERNAME_USER_MESSAGE;
                break;
            }
            if ($password != $repeatPassword) {
                $error = true;
                $message = self::PASSWORD_USER_MESSAGE;
                break;
            }
            if (!checkdate($mesNac, $diaNac, $anoNac)) {
                $error = true;
                $message = self::DATE_USER_MESSAGE;
                break;
            }
            $bucle = false;
        }

        return array('error' => $error, 'message' => $message);
    }


    private function validateString($rule, $string)
    {
        switch ($rule) {
            case 1:
                //Username
                $caracters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                break;
            case 2:
                //Nombre o apellido
                $caracters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZáéíóúäëïöüÄËÏÖÜàèìòùÀÈÌÒÙâêîôûÂÊÎÔÛçÇ0123456789 ";
                break;
        }
        $status = null;
        for ($a = 0; $a < strlen($string); $a++) {
            if (strpos($caracters, substr($string, $a, 1)) === false) {
                $status = 1;
                break;
            }
        }

        return $status;
    }

    function validateEmailFormat($email)
    {
        if ($email != "") {
            $text = preg_split('/@/', $email);
            if (sizeof($text) == 2 && $text[0] != null && $text[1] != null) {
                $text2 = preg_split('/\./', $text[1]);
                if (sizeof($text2) == 2 && $text2[0] != "" && $text2[1] != "") {
                    return 1;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
}
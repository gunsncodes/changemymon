<?
namespace cambiomidinero\Http\Controllers;

class FunctionController extends Controller
{

    function formatStringUperCase($string)
    {
        $lowerString = strtolower($string);
        return ucwords($lowerString);
    }


    /**
     * @param $nameUser
     *  Es el nombre del usuario
     * @param $lastnameUser
     *  Es el apellido del usuario
     * @param $format
     *  Es el formato que se desea obtener.
     * 1: (Nombre Apellido)
     * 2: (Nombre A.)
     * @return $resultNameUser
     *  Regresa el nombre del usuario según el formato deseado
     *
     */
    function formatNameUser($nameUser, $lastNameUser, $format)
    {
        $resultNameUser = '';
        switch ($format) {
            case 1:
                //Name Lastname
                $name = explode(' ', $nameUser);
                $lastName = explode(' ', $lastNameUser);
                $resultNameUser = $name[0] . ' ' . $lastName[0];
                break;
            case 2:
                //Name L
                $name = explode(' ',$nameUser);
                $lastName =  substr($lastNameUser,0,1);
                $resultNameUser =  $name[0]. ' '.$lastName.".";
                break;
        }
        return $resultNameUser;
    }

}

?>
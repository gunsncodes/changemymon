<?
namespace cambiomidinero\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Mail;

class MailingController extends Controller
{

    private $to;
    private $from = 'cambiomidinero@cambiomidinero.com';
    private $name = 'CAMBIOMIDINERO';
    private $subject;
    private $message;
    private $cc;
    private $securityController;
    private $userId;

    public function sendTemplate($to, $numberTemplate)
    {
        $errorController = new ErrorController();
        $template = $this->getTemplate($numberTemplate);
        $this->setMessage($template['message']);
        $this->setTo($to);
        $this->setSubject($template['subject']);

        try {
            Mail::send($template['message'],$template['data'], function ($message) {
                $message->from($this->getFrom(), $this->getName());
                $message->subject($this->getSubject());
                $message->to($this->getTo());
            });
            $error = env('SUCCESS_STATUS');
        } catch (\Exception $e) {
            $error = env('ERROR_STATUS');
            $errorController->registerError($e, __LINE__);
        }
        return $error;
    }

    private function getTemplate($number)
    {
    $template = null;

        switch ($number):

            case 1:
                $securityController = new SecurityController();
                $template = array('subject' => 'Confirmación de registro',
                                  'message' => 'templates.mail.MailViewRegister',
                                  'data'=>array('stream'=>$this->getSecurityController()->getStream()));
                $this->setSecurityController($securityController);
                break;
            case 2:
                $usuarioController = new UsuarioController();
                $informationUser = $usuarioController->getUserAccessByUserId($this->getUserId());
                $nameUser = $informationUser->usuario_nombre.' '.$informationUser->usuari_apellido;
                $template = array('subject' => 'Datos de acceso',
                    'message' => 'templates.mail.MailViewRecoveryAccount',
                    'data'=>array('nameUser'=>$nameUser,
                        'username'=>$informationUser->acceso_usuario,
                        'password'=>$informationUser->acceso_clave));
                break;
        endswitch;

        return $template;

    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @param mixed $cc
     */
    public function setCc($cc)
    {
        $this->cc = $cc;
    }

    /**
     * @return mixed
     */
    public function getSecurityController()
    {
        return $this->securityController;
    }

    /**
     * @param mixed $securityController
     */
    public function setSecurityController($securityController)
    {
        $this->securityController = $securityController;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }


}

?>
<?php

/**
 * Modelo del modulo Core que se encarga de inicializar  la clase de envio de correos
 */
class Core_Model_Mail
{
    /**
     * classe de  phpmailer
     * @var class
     */
    private $mail;

    /**
     * asigna los valores a la clase e instancia el phpMailer
     */
    public function __construct()
    {

        $this->mail = new PHPMailer;
        $this->mail->CharSet = 'UTF-8';
        $this->mail->isSMTP();
        $this->mail->SMTPDebug = 0;
        $this->mail->SMTPSecure = "ssl";
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->Port = 465;
        $this->mail->SMTPAuth = true;
        $this->mail->Username = "solicitudcredito@fendesa.com";
        $this->mail->Password = "mjnp crou ukmf ptog"; //fendesa2019
        $this->mail->setFrom("solicitudcredito@fendesa.com", "Notificaciones FENDESA");
    }
    /**
     * retorna la  instancia de email
     * @return class email
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * envia el correo
     * @return bool envia el estado del correo
     */
    public function sed()
    {
        if ($this->mail->send()) {
            return true;
        } else {

            $this->mail->Username = "deliveryclubelnogal@gmail.com";
            $this->mail->Password = "Admin.2008";
            $this->mail->send();

            return false;
        }
    }
}

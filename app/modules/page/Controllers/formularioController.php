<?php

/**
 * Controlador para manejar el formulario de contacto
 * Gestiona la visualización y envío de formularios con validación y protección anti-spam
 */
class Page_formularioController extends Page_mainController
{
    /**
     * Muestra la página del formulario de contacto
     */
    public function indexAction()
    {
        $this->_view->bannersimple = $this->template->bannerprincipal(1);
        $this->_view->contenido = $this->template->getContentseccion(3);
        $this->_view->res = $this->_getSanitizedParam('res');

        // Cargar términos y condiciones
        $portafoliosModel = new Page_Model_DbTable_Contenido();
        $this->_view->terminos = $this->template->getContentseccion(10);
    }

    /**
     * Procesa el envío del formulario de contacto
     */
    public function enviarAction()
    {
        $this->setLayout('blanco');

        // Solo procesar solicitudes POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectWithResult(3); // Error: método no permitido
            return;
        }

        // Recopilar datos del formulario
        $formData = $this->getFormData();

        // Verificar honeypot (anti-spam)
        if ($this->isSpamSubmission($formData)) {
            $this->redirectWithResult(4); // Spam detectado
            return;
        }

        // Verificar captcha
        $captchaResponse = $this->_getSanitizedParam('g-recaptcha-response');
        if (!$this->verifyCaptcha($captchaResponse)) {
            $this->redirectWithResult(3); // Error de captcha
            return;
        }

        // Validar campos requeridos
        if (!$this->validateRequiredFields($formData)) {
            $this->redirectWithResult(2); // Campos faltantes
            return;
        }

        // Enviar email
        $result = $this->sendContactEmail($formData);
        $this->redirectWithResult($result);
    }

    /**
     * Recopila y sanitiza los datos del formulario
     */
    private function getFormData()
    {
        return [
            'formulario_nombre' => $this->_getSanitizedParam('formulario_nombre'),
            'formulario_email' => $this->_getSanitizedParam('formulario_email'),
            'formulario_telefono' => $this->_getSanitizedParam('formulario_telefono'),
            'formulario_ciudad' => $this->_getSanitizedParam('formulario_ciudad'),
            'formulario_mensaje' => $this->_getSanitizedParam('formulario_mensaje'),
            'formulario_correo' => $this->_getSanitizedParam('formulario_correo'), // Honeypot
        ];
    }

    /**
     * Verifica si es una submisión de spam usando honeypot
     */
    private function isSpamSubmission($formData)
    {
        return !empty($formData['formulario_correo']);
    }

    /**
     * Valida que todos los campos requeridos estén completos
     */
    private function validateRequiredFields($formData)
    {
        $requiredFields = [
            'formulario_nombre',
            'formulario_email',
            'formulario_telefono',
            'formulario_ciudad',
            'formulario_mensaje'
        ];

        foreach ($requiredFields as $field) {
            if (empty(trim($formData[$field]))) {
                return false;
            }
        }

        return true;
    }

    /**
     * Envía el email de contacto
     */
    private function sendContactEmail($formData)
    {
        try {
            $mailService = new Core_Model_Sendingemail($this->_view);
            return $mailService->sendMailContact($formData);
        } catch (Exception $e) {
            // Log del error si es necesario
            return 3; // Error en el envío
        }
    }

    /**
     * Redirige con código de resultado
     */
    private function redirectWithResult($resultCode)
    {
        header("Location: /page/formulario?res=" . $resultCode);
        exit;
    }
    /**
     * Verifica la validez del captcha de reCAPTCHA
     */
    public function verifyCaptcha($response)
    {
        if (empty($response)) {
            return false;
        }

        $secretKey = '6LfFDZskAAAAAOvo1878Gv4vLz3CjacWqy08WqYP';
        $url = 'https://www.google.com/recaptcha/api/siteverify';

        $data = [
            'secret' => $secretKey,
            'response' => $response
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === false) {
            return false; // Error al conectar con reCAPTCHA
        }

        $response = json_decode($result);
        return isset($response->success) && $response->success === true;
    }
}

<?php

final class Payment_Placetopay
{
    protected $_data = null;
    private static $_instance = null;
    protected $placetopay ;

    private function __construct()
    {
        $data = array();
        $data['url'] = Config_Config::getInstance()->getValue('placetopay/url');
        $data['login'] = Config_Config::getInstance()->getValue('placetopay/login');
        $data['tranKey'] = Config_Config::getInstance()->getValue('placetopay/tranKey');
        $data['returnUrl'] = Config_Config::getInstance()->getValue('placetopay/returnUrl');
        $this->_data = $data;
        $this->placetopay = new Dnetix\Redirection\PlacetoPay([
            'login' =>  $this->_data['login'],
            'tranKey' => $this->_data['tranKey'],
            'url' => $this->_data['url']
        ]);

        

       
    }
    
    public function getPlacetopay(){
        return  $this->placetopay;
    }

    public function getData()
    {

        return $this->_data;
    }


    public static function getInstance()
    {
        if (null == self::$_instance) {
            self::$_instance = new Payment_Placetopay();
        }
        return self::$_instance;
    }
}
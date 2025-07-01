<?php

final class Payment_Payu
{
    protected $_data = null;
    private static $_instance = null;

    private function __construct()
    {
        $data = array();
        $data['url'] = Config_Config::getInstance()->getValue('payu/url');
        $data['merchantId'] = Config_Config::getInstance()->getValue('payu/merchantId');
        $data['ApiKey'] = Config_Config::getInstance()->getValue('payu/ApiKey');
        $data['accountId'] = Config_Config::getInstance()->getValue('payu/accountId');
        $data['test'] = Config_Config::getInstance()->getValue('payu/test');
        $data['buyerEmail'] = Config_Config::getInstance()->getValue('payu/buyerEmail');
        $data['responseUrl'] = Config_Config::getInstance()->getValue('payu/responseUrl');
        $data['confirmationUrl'] = Config_Config::getInstance()->getValue('payu/confirmationUrl');
        $this->_data = $data;
    }

    public function getData()
    {

        return $this->_data;
    }

    public static function getInstance()
    {
        if (null == self::$_instance) {
            self::$_instance = new Payment_Payu();
        }
        return self::$_instance;
    }
}
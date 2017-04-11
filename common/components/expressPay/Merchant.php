<?php

namespace common\components\expressPay;

use yii\base\Object;
use yii\helpers\Json;

class Merchant extends Object
{
    const STATUS_PENDING_PAYMENT = 1;   // Ожидает оплату

    const STATUS_OVERDUE = 2;   // Просрочен

    const STATUS_PAID = 3;   // Оплачен

    const STATUS_PARTIALLY_PAID = 4;   // Оплачен частично

    const STATUS_CANCELED = 5;   // Отменен

    public $isTestMode = true;     // включить/выключить тестовый режим

    public $needSigned = false;    // включить/выключить цифровую подпись

    public $token = '';    // Api ключ

    public $accountNo = '';    // Номер лицевого счета

    public $currency = 933;    // Код валюты (933 - BYN)

    private $apiUrl;    // Адрес API

    public function init()
    {
        if ($this->isTestMode) {
            $this->apiUrl = "https://sandbox-api.express-pay.by/v1/";
        } else {
            $this->apiUrl = "https://api.expressPay.by/v1/";
        }
    }

    /**
     * Выставляем счет в системе ЕРИП
     *
     * @param double $amount Сумма счета на оплату
     * @return bool|mixed
     */
    public function addInvoice($amount)
    {
        $getData = ['token' => $this->token];
        $postData = [
            'AccountNo' => $this->accountNo,
            'Amount' => $amount,
            'Currency' => $this->currency
        ];
        $result = $this->sendRequest('invoices', $getData, $postData);
        return isset($result['InvoiceNo']) ? $result['InvoiceNo'] : false;
    }

    /**
     * Отправка запроса
     *
     * @param $uri
     * @param array $getData
     * @param array $postData
     * @return array
     */
    private function sendRequest($uri, $getData = [], $postData = [])
    {
        $url = $this->apiUrl . $uri;
        if (!empty($getData)) {
            foreach ($getData as $key => $value) {
                $url .= (strpos($url, '?') !== false ? '&' : '?') . urlencode($key) . '=' . rawurlencode($value);
            }
        }

        $post = !empty($postData)? true : false;

        $ch = curl_init($url);

        if ($post) {
            curl_setopt($ch, CURLOPT_POST, true);
        }

        if (!empty($postData)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        return Json::decode($response);
    }
}
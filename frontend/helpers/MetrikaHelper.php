<?php

namespace frontend\helpers;

use yii\helpers\ArrayHelper;

class MetrikaHelper
{
    public static function getUsersCount()
    {
        $obj = new self();
        $response = $obj->query('ym:s:users');
        if ($response) {
            $response = json_decode($obj->query('ym:s:users'));
            return (int)ArrayHelper::getValue($response, 'totals.0');
        }
        return 0;
    }

    public static function getPageViews()
    {
        $obj = new self();
        $response = $obj->query('ym:s:pageviews');
        if ($response) {
            $response = json_decode($obj->query('ym:s:users'));
            return (int)ArrayHelper::getValue($response, 'totals.0');
        }
        return 0;
    }

    private function query($metrics)
    {
        $date = date('Y-m-d', strtotime('-1 day'));
        $url = 'https://api-metrika.yandex.ru/stat/v1/data';
        $url .= '?id='. getenv('METRIKA_ID');
        $url .= '&oauth_token='. getenv('METRIKA_TOKEN');
        $url .= '&group=day';
        $url .= '&metrics=' . $metrics;
        $url .= '&date1=' . $date . '&date2=' . $date;
        try {
            $json = file_get_contents($url);
            return $json;
        } catch (\Exception $e) {
            return false;
        }
    }
}
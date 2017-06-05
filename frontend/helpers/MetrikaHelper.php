<?php

namespace frontend\helpers;

use Yii;
use yii\helpers\ArrayHelper;

class MetrikaHelper
{
    public static function getUsersCount()
    {
        $cache = Yii::$app->cache;
        $count = $cache->get('metrika_users');
        if (!$count) {
            $obj = new self();
            $response = $obj->query('ym:s:users');
            $count = 0;
            if ($response) {
                $response = json_decode($response);
                $count = (int)ArrayHelper::getValue($response, 'totals.0');
            }
            $cache->add('metrika_users', $count, 60*60);
        }
        return $count;
    }

    public static function getPageViews()
    {
        $cache = Yii::$app->cache;
        $count = $cache->get('metrika_pageviews');
        if (!$count) {
            $obj = new self();
            $response = $obj->query('ym:s:pageviews');
            $count = 0;
            if ($response) {
                $response = json_decode($response);
                $count = (int)ArrayHelper::getValue($response, 'totals.0');
            }
            $cache->add('metrika_pageviews', $count, 60*60);
        }
        return $count;
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
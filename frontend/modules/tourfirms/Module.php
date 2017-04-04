<?php

namespace frontend\modules\tourfirms;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\tourfirms\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public static function getStyleForReviews($newNum) {
        switch($newNum) {
            case $newNum > 4.4:
                $styleReview = "green";
                break;
            case $newNum > 3.9 && $newNum < 4.5:
                $styleReview = "lime";
                break;
            case $newNum > 2.9 && $newNum < 4:
                $styleReview = "lime-orange";
                break;
            case $newNum > 1.9 && $newNum < 3:
                $styleReview = "brown";
                break;
            default :
                $styleReview = "red";
        }
        return $styleReview;
    }

    public static function getActiveClass($url, $cat) {
        if(stristr($url, $cat)) {
            return 'class="active"';
        }
        else {
            return '';
        }
    }
}

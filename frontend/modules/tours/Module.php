<?php

namespace frontend\modules\tours;

use common\models\ToursComparison;
use common\models\ToursFavorits;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\tours\controllers';

    public static function getFavorits($id){
        $model = ToursFavorits::find()->where(['tour_id'=>$id, 'user_id'=>user()->id])->one();
        if($model){
            return 1;
        }
        else{
            return 0;
        }
    }

    public static function getComparison($tour_id){
        $model = ToursComparison::find()->where(['tour_id'=>$tour_id, 'user_id'=>user()->id])->all();
        if($model){
            $count = ToursComparison::find()->where(['user_id'=>user()->id])->all();
            switch(count($count)){
                case 1:
                    $str = 'тур в сравнении';
                    break;
                case (count($count) > 1 && count($count) < 5):
                    $str = 'тура в сравнении';
                    break;
                default:
                    $str = 'туров в сравнении';
            }
            return count($count)." ".$str;
        }
        else{
            return 0;
        }
    }

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}

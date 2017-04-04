<?php

namespace frontend\modules\visa;

use common\models\VisaComparison;
use common\models\VisaFavorites;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\visa\controllers';

    public static function getFavorits($id){
        $model = VisaFavorites::find()->where(['visa_id'=>$id, 'user_id'=>user()->id])->one();
        if($model){
            return 1;
        }
        else{
            return 0;
        }
    }

    public static function getComparison($visa_id){
        $model = VisaComparison::find()->where(['visa_id'=>$visa_id, 'user_id'=>user()->id])->all();
        if($model){
            $count = VisaComparison::find()->where(['user_id'=>user()->id])->all();
            switch(count($count)){
                case 1:
                    $str = 'виза в сравнении';
                    break;
                case (count($count) > 1 && count($count) < 5):
                    $str = 'визы в сравнении';
                    break;
                default:
                    $str = 'виз в сравнении';
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

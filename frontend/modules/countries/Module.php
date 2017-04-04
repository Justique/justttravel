<?php

namespace frontend\modules\countries;

use common\models\Countries;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\countries\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public static function getAlphavit(){
        $abc = array();
        $model = Countries::find()->all();
        foreach($model as $letter) {
            $abc[] = mb_substr($letter->name, 0, 1, "UTF-8");
        }
        return array_unique($abc);

    }
}

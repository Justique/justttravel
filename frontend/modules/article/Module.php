<?php

namespace frontend\modules\article;

use yii\helpers\Html;
use yii\helpers\Url;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\article\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public static function urlAll(){
        return Url::toRoute('article/default/index');
    }
}

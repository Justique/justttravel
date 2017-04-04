<?php

namespace frontend\modules\user;

use yii\helpers\Url;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\user\controllers';

    public static function LogoutUrl(){
        return url('/user/sign-in/logout');
    }

    public static function ProfileUrl()
    {
        return url('/user/default/index');
    }

    public static function SignUpUrl(){
        return url('/signup');
    }

    public static function getCountPeoples($childrens, $adults) {
        $count = $childrens + $adults;
        $html = '';
        switch($count){
            case 1:
                $html = '<div class="tour-capacity"><i class="fa fa-smile-o"></i><span>на одного</span></div>';
                break;
            case 2:
                $html = '<div class="tour-capacity"><i class="fa fa-smile-o"></i><i class="fa fa-smile-o"></i><span>на двоих</span></div>';
                break;
            case $count > 2:
                $html = '<div class="tour-capacity"><i class="fa fa-smile-o"></i><i class="fa fa-smile-o"></i><i class="fa fa-smile-o"></i><span>на компанию</span></div>';
                break;
        }
        return $html;
    }

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}

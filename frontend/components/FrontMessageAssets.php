<?php
/**
 * Created by PhpStorm.
 * User: Alexandr
 * Date: 20.04.2016
 * Time: 18:59
 */
namespace frontend\components;

class FrontMessageAssets extends \yii\web\AssetBundle {
    public $sourcePath = '@app/web';

    public $js = [
        'js/private_mess_cload.js'
    ];

    public $css = [
        'css/cload_message.css',
    ];

    public $depends = [
        'vision\messages\assets\PrivateMessPoolingAsset',
        'vision\messages\assets\TinyscrollbarAsset',
        'vision\messages\assets\SortElementsAsset'
    ];


}
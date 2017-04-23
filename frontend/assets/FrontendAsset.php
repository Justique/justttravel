<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FrontendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'v1/css/style.css',
        'v1/css/preloader.css',
        'v1/css/font-awesome.min.css',
        'v1/plugins/lightbox2/css/lightbox.min.css',
        'css/sweetalert2.css',
        'css/dopstyle.css',
        //'css/customSelectBox.css',
        //'css/jquery.jscrollpane.css',
        'Formstone/dist/css/themes/light.css',
        'Formstone/dist/css/scrollbar.css',
        'Formstone/dist/css/dropdown.css',
    ];

    public $js = [
        'v1/js/jquery.easyModal.js',
        'v1/js/main.js',
        'v1/plugins/lightbox2/js/lightbox.min.js',
        'js/masonry.pkgd.min.js',
        'js/application.js',
        'js/sweetalert2.min.js',
        'js/securepassword.js',
        //'js/SelectBox.js',
        //'js/jScrollPane.js',
        //'js/jquery.mousewheel.js',
        'Formstone/dist/js/core.js',
        'Formstone/dist/js/dropdown.js',
        'Formstone/dist/js/scrollbar.js',
        'Formstone/dist/js/touch.js',
        
    ];

    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset'
//        'yii\bootstrap\BootstrapPluginAsset'
        //'common\assets\Html5shiv',
    ];
}

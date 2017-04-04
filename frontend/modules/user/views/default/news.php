<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'User Settings')
?>
<div class="head-symbol"><i class="fa fa-commenting"></i></div>
<h1><?php echo Yii::t('frontend', 'Profile settings') ?></h1>
<?php if (!userModel()->isUserTourOperator()) { ?>
    <ul>
        <li><a href="#">Личные данные</a></li>
        <li><a href="#">Данные акаунта</a></li>
        <li><a href="#">Попутчики</a></li>
        <li><a href="#">Избранное</a></li>
        <li><a href="#">В сравнени</a></li>
    </ul>
<?php } else { ?>
    <ul>
        <li><a href="#">Данные компании</a></li>
        <li><a href="#">Данные акаунта</a></li>
        <li><a href="#">Туры компании</a></li>
        <li><a href="#">Менеджеры компании</a></li>
        <li><a href="#">Новости\Акции</a></li>
        <li><a href="#">Контактные данные</a></li>
    </ul>
<?php } ?>
<section class="register-page">
    <div class="content-wrapper">
        <div class="container">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'title',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</section>
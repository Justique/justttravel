<?php

use common\models\Countries;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companiones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать заявку', ['create'], ['class' => 'button yellow button_main']) ?>
    </p>
    <div style="display: none">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'age_with',
            'age_to',
            'type_travel_id',
            // 'purpose_travel',
            // 'about_me',
            // 'about_traveler',
            // 'travel_location',
            // 'gender_traveler',
            // 'iterests',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    <div class="companions-container">
        <ul class="tours-list tour_orders_list">
        <?php foreach($myCompaniones as $item){ ?>
                <li>
                <article>
                    <div class="main-info">
                        <div class="creds">
                            <a href="#">
                                <?php
                                echo \yii\helpers\Html::img(
                                    Yii::$app->glide->createSignedUrl([
                                        'glide/index',
                                        'path' => getAvatar($item->user_id),
                                        'w' => 200
                                    ], true)
                                );
                                ?>
                                <i class="fa fa-comment"></i>
                            </a>
                            <div>
                                <p class="name"><span><?php echo $item->myCompaniones->firstname." ".$item->myCompaniones->lastname ?></span><span class="age <?php echo \common\models\Companiones::getClassGender($item->myCompaniones->gender) ?>"><?php echo getFullYears($item->myCompaniones->byear, $item->myCompaniones->bmonth, $item->myCompaniones->bday) ?></span><span class="location"><?php echo Countries::getCountry($item->myCompaniones->country)?>, <?php echo \common\models\Cities::getCity($item->myCompaniones->country)?></span></p>
                                <div><i class="fa fa-transgender"></i>Ищу в попутчики компанию</div>
                                <div><i class="fa fa-user"></i>Возраст <?php echo $item->age_with?></div>
                            </div>
                        </div>
                        <div class="target">
                            <p class="destination"><?php echo $item->travel_location?></p>
                            <p><span>Цель поездки:</span><?php echo $item->purpose_travel?></p>
                            <p><span>О себе:</span> <?php echo $item->about_me?></p>
                            <p><span>О попутчике:</span> <?php echo $item->about_traveler?></p>
                        </div>
                    </div>
                    <?php foreach($item->tagLinks as $link){ ?>
                        <a href="#" class="tag"><?php echo $link ?> </a>
                    <?php } ?>
                </article>
                    <a href="#" class="orders_form_trigger">Изменить</a>
                </li>
                <li class="form container">
                    <?php echo \frontend\modules\user\widgets\companiones\Companiones::widget(['companion_id'=>$item->id ]) ?>
                </li>
        <?php } ?>
        </ul>
    </div>
</div>


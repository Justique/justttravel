<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\user\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Менеджеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="head-symbol"><i class="fa fa-smile-o"></i></div>
<h1><?= Html::encode($this->title) ?></h1>
<p>
    <?= Html::a('Добавить менеджера', ['create'], ['class' => 'button yellow button_main']) ?>
</p>
<div class="user-index" style="display: none">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<section>
        <div class="wrapper">
            <div class="wrapper-inner">
                <div class="company-managers">
                    <?php foreach ($dataProvider->getModels() as $manager) { ?>
                        <?php if($manager->userProfile){ ?>
                            <div class="manager">
                                <div>
                                    <div class="controls">
                                        <a href="/user/manager/update?id=<?php echo $manager->id ?>" class="edit"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="/user/manager/delete?id=<?php echo $manager->id ?>" class="delete"  title="удалить" aria-label='Удалить' data-confirm='Вы уверены, что хотите удалить этот элемент?' data-method='post' data-pjax=0><i class="fa fa-times"></i></a>
                                    </div>
                                    <?php
                                    echo Html::img(
                                        Yii::$app->glide->createSignedUrl([
                                            'glide/index',
                                            'path' => $manager->userProfile->avatar_path,
                                            'w' => 100
                                        ], true)
                                    );
                                    ?>
                                </div>
                                <ul class="manager-contact">
                                    <?php if(isset($manager->phone->default)){?><li class="contact-phone"><?php echo $manager->phone->default ?></li><?php } ?>
                                    <?php if(isset($manager->phone->life)){?><li class="contact-life"><?php echo $manager->phone->life ?></li><?php } ?>
                                    <?php if(isset($manager->phone->mts)){?><li class="contact-mts"><?php echo $manager->phone->mts ?></li><?php } ?>
                                    <?php if(isset($manager->phone->viber)){?><li class="contact-viber"><?php echo $manager->phone->viber ?></li><?php } ?>
                                    <?php if(isset($manager->phone->skype)){?><li class="contact-skype"><?php echo $manager->phone->skype ?></li><?php } ?>
                                    <?php if(isset($manager->phone->icq)){?><li class="contact-icq"><?php echo $manager->phone->icq ?></li><?php } ?>
                                </ul>
                                <p><?php if($manager->userProfile->firstname && $manager->userProfile->lastname) { echo $manager->userProfile->firstname ." ". $manager->userProfile->lastname;  }else {echo $manager->username; }?></p>
                            </div>
                        <?php } ?>
                    <?php } ?>

                </div>

            </div>
        </div>
    </section>

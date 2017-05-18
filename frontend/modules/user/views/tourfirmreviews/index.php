<?php

use common\models\Tourfirms;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TourfirmsReviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отзывы турфирмы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tourfirms-reviews-index">
    <div class="head-symbol"><i class="fa fa-star"></i></div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(Tourfirms::getTourfirmId(user()->id)){ ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div style="display: none">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'comment',
                'label' => 'Комментарий',
            ],
           [
                'attribute'=>'userName',
                'label' => 'Юзер',
           ],
           [
                'attribute' => 'date_create',
                'label' => 'Дата создания',
                'value' => function($model){
                    return date('d-m-Y', $model->date_create);
                }
            ],
            [
                'attribute' => 'status',
                'label' => 'Опубликовано',
                'format' => 'raw',
                'value' => function ($model, $index) {
                    return Html::checkbox('status[]', $model->status, ['value' => $index]);
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url) {
                        return Html::a(
                            '<span class="fa fa-trash"></span>',
                            $url, ['title'=>'удалить', "aria-label"=>'Удалить', 'data-confirm'=>'Вы уверены, что хотите удалить этот элемент?','data-method'=>'post', 'data-pjax'=>0]);
                    },
                ],
                'buttonOptions' => ['class' => '']
            ],
        ],
    ]); ?>
</div>
    <div class="container company-reports">
        <?php foreach ($dataProvider->getModels() as $item): ?>
            <?php if ($item->status == 1): ?>
                <div class="report">
                    <span class="rating-grade <?php echo \frontend\modules\tourfirms\Module::getStyleForReviews(\common\models\Tourfirms::getPercentVotes($item->id)) ?>"><?php echo \common\models\Tourfirms::getPercentVotes($item->id)?></span>
                    <div class="box">
                        <span class="datemark"><?php echo rus_date('d F Y', $item->date_create) ?></span>
                        <?php echo $item->comment ?>
                        <div class="report-photos">
        <!--                    <img src="" alt="" style="background: black;">-->
                        </div>
                        <div class="actions">
                            <span class="spacer"></span>
                            <div class="likes">
                                <a href="/tourfirms/savevotes?reviews_id=<?php echo $item->id ?>&user_id=<?php echo user()->id ?>&vote=1" class="like ajax-link"><i class="fa fa-thumbs-up"></i><?php echo \common\models\ReviewsVotes::getCountVotes(1, $item->id) ?></a>
                                <a href="/tourfirms/savevotes?reviews_id=<?php echo $item->id ?>&user_id=<?php echo user()->id ?>&vote=0" class="unlike ajax-link"><i class="fa fa-thumbs-down"></i><?php echo \common\models\ReviewsVotes::getCountVotes(0, $item->id) ?></a>
                            </div>
                            <p><i class="fa fa-user"></i>Автор отзыва: <a href="/profile/messages?messager_id=<?php echo $item->user_id ?>"><?php echo $item->user->firstname  ?></a></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<?php }else {?>
    <p>
        Турфирма еще не создана!
    </p>
<?php } ?>

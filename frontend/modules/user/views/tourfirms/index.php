<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TourfirmsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Турфирма';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tourfirms ">
    <div class="head-symbol"><i class="fa fa-diamond" aria-hidden="true"></i></div>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if(!\common\models\Tourfirms::getTourfirmId(user()->id)){ ?>
    <p>
        <?= Html::a('Создать турфиму', ['create'], ['class' => 'button yellow button_main']) ?>
    </p>
    <?php } ?>
    <div style="display: none;">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'description:ntext',
            'address',
            // 'phone',
            // 'slug',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    <?php foreach($dataProvider->getModels() as $item){ ?>
                <?php echo \frontend\modules\user\widgets\tourfirm\Tourfirm::widget(['tourfirm_id'=>$item->id ]) ?>
    <?php } ?>
</div>

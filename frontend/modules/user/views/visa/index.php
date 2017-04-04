<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\VisaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Визы Компании';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visa-index">
    <div class="head-symbol"><i class="fa fa-folder" aria-hidden="true"></i></div>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if($flagTourfirm){ ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Создать визу', ['create'], ['class' => 'button yellow button_main']) ?>
    </p>
    <div style="display: none">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'description',
            'slug',
            'price',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    <ul class="tours-list tour_orders_list">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'class' => 'visa-list'
        ],
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_item',
    ]) ?>
    </ul>

</div>
<?php }else{ ?>
    <p>
        Турфирма еще не создана!
    </p>
<?php } ?>

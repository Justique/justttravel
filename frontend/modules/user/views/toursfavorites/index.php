<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ToursFavorits */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tours Favorits';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="visa-page">
    <div class="content-wrapper with-counter">
        <h1>Избранные туры<span class="country-count"><?php echo $dataProvider->getTotalCount(); ?></span></h1>
        <ul class="tours-list">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'class' => ''
                ],
                'itemOptions' => ['class' => 'tours-list'],
                'itemView' => '_item',
            ]) ?>
        </ul>
    </div>
</section>

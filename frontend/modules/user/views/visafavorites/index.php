<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\VisaFavorites */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Visa Favorites';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="visa-page">
    <div class="content-wrapper with-counter">
        <h1>Все визы<span class="country-count"><?php echo $dataProvider->getTotalCount(); ?></span></h1>
        <p>Визы всех турфирм из нашего каталога</p>
        <ul class="visa-list">
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
</section>

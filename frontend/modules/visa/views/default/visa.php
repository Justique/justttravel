<?php
use yii\widgets\ListView;
use yii\widgets\LinkPager;
?>
<section class="visa-page">
    <div class="content-wrapper with-counter">
        <h1>Все визы<span class="country-count"><?php echo $dataProvider->getTotalCount(); ?></span></h1>
        <p>Визы всех турфирм из нашего каталога</p>
        <p class="sort">Сортировать по:<?php echo $sort->link('date_create')?><?php echo $sort->link('price')?></p>
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
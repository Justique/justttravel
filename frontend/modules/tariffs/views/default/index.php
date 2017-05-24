<?php

use common\models\Tariffs;
use yii\helpers\Html;

/* @var $tariffs common\models\Tariffs[] */

$this->title = 'Тарифы';
?>
<div class="wrapper wrapper-tariffs">
    <h1>Наши тарифы</h1>

    <div class="tariffs-box">
        <?php foreach ($tariffs as $tariff): ?>
            <div class="tariff-item">
                <div class="tariff-header">
                    <div class="tariff-name"><?= $tariff->name ?></div>
                    <?php if ($tariff->price == 0): ?>
                        <div class="tariff-price">бесплатно!</div>
                    <?php else: ?>
                        <div class="tariff-price"><?= $tariff->price ?>.<sup>00 руб./мес.</sup></div>
                    <?php endif; ?>
                    <?php if ($tariff->recommend): ?>
                        <div class="tariff-recommend">рекомендуем</div>
                    <?php endif; ?>
                </div><!-- .tariff-header -->
                <div class="tariff-content">
                    <ul class="tariff-points">
                        <li><span><i class="fa fa-<?= $tariff->count_tours == 0 ? 'times' : 'check' ?>" aria-hidden="true"></i><?= $tariff->getText('count_tours') ?></span></li>
                        <li><span data-tooltip="ап - возможность поднять вверх списка свой тур или визу."><i class="fa fa-<?= $tariff->count_up_tours == 0 ? 'times' : 'check' ?>" aria-hidden="true"></i><?= $tariff->getText('count_up_tours') ?></span></li>
                        <li><span><i class="fa fa-<?= $tariff->count_visas == 0 ? 'times' : 'check' ?>" aria-hidden="true"></i><?= $tariff->getText('count_visas') ?></span></li>
                        <li><span><i class="fa fa-<?= $tariff->count_up_visas == 0 ? 'times' : 'check' ?>" aria-hidden="true"></i><?= $tariff->getText('count_up_visas') ?></span></li>
                        <li><span><i class="fa fa-<?= $tariff->news == 0 ? 'times' : 'check' ?>" aria-hidden="true"></i>новости, акции</span></li>
                        <li><span><i class="fa fa-<?= $tariff->count_responses == 0 ? 'times' : 'check' ?>" aria-hidden="true"></i><?= $tariff->getText('count_responses') ?></span></li>
                        <li><span><i class="fa fa-<?= $tariff->count_managers == 0 ? 'times' : 'check' ?>" aria-hidden="true"></i><?= $tariff->getText('count_managers') ?></span></li>
                        <li><span><i class="fa fa-<?= $tariff->placement == 0 ? 'times' : 'check' ?>" aria-hidden="true"></i>размещение в каталоге</span></li>
                    </ul>
                    <?= Html::a('РЕГИСТРАЦИЯ', ['/signup', 't' => $tariff->id], ['class' => 'btn-blue'])?>
                </div><!-- .tariff-content -->
            </div><!-- .tariff-item -->
        <?php endforeach; ?>
    </div><!-- .tariffs-box -->

    <div class="c-text">
        <p>Описательный текст</p>
    </div>

    <div class="c-discount">
        <div class="discount-header"><span><img src="v1/img/percent.jpg" alt=""></span>Скидки на размещение</div>
        <div class="discount-row">
            <div class="discount-item">
                <div class="discount-value"><?= getenv('DISCOUNT_6_MONTH') ?><sup>%</sup></div>
                <div class="discount-title">При размещении на 6 месяцев</div>
            </div><!-- .discount-item -->

            <div class="discount-item">
                <div class="discount-value"><?= getenv('DISCOUNT_12_MONTH') ?><sup>%</sup></div>
                <div class="discount-title">При размещении на 12 месяцев</div>
            </div><!-- .discount-item -->
        </div><!-- .discount-row -->
    </div><!-- .c-discount -->
</div>


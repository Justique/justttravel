<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $tariffs common\models\Tariffs[] */
/* @var $user_tariff common\models\UserTariff */
/* @var $payments common\models\Payment[] */
/* @var $payment_total integer */
?>

<div class="head-symbol"><i class="fa fa-tachometer" aria-hidden="true"></i></div>
<h1>Панель управления</h1>

<div class="cnp-tariff">
    <div class="cnp-col">

        <div class="cnp-title">Сменить тариф</div>

        <?php $form = ActiveForm::begin() ?>
            <?= Html::dropDownList('tariff', null, $tariffs, ['prompt' => '']) ?>

            <button class="button yellow">изменить</button>

        <?php ActiveForm::end(); ?>

        <div class="help-block"></div>
    </div><!-- .cnp-col -->

    <div class="cnp-col cnp-col-board">
        <div class="cnp-title">Ваш действующий тариф</div>
        <div class="cnp-board">
            <div class="cnp-tariff-title"><?= $user_tariff->tariff->name ?></div>
            <?php if ($user_tariff->tariff->price == 0): ?>
                <div class="cnp-tariff-price">бесплатно!</div>
            <?php else: ?>
                <div class="cnp-tariff-price"><?= $user_tariff->tariff->price ?>.<sup>000 руб./мес.</sup></div>
            <?php endif; ?>
        </div><!-- .cnp-board -->
    </div><!-- .cnp-col -->

    <div class="cnp-col cnp-col-board">
        <div class="cnp-title">Срок действия</div>
        <div class="cnp-board">
            <?php if ($user_tariff->tariff->price == 0): ?>
                <div class="cnp-remain-note" style="font-size: 70px;">∞</div>
            <?php else: ?>
                <div class="cnp-remain-date">до <?= date('d.m.Y', $user_tariff->valid_at)?></div>
                <div class="cnp-remain-note">осталось</div>
                <div class="cnp-remain-value"><?= date_diff(new \DateTime(), new \DateTime(date('Y-m-d', $user_tariff->valid_at)))->format('%a') ?> дней</div>
            <?php endif; ?>
        </div><!-- .cnp-board -->
    </div><!-- .cnp-col -->

    <?php if ($user_tariff->tariff->price > 0): ?>
        <div class="cnp-col">
            <div class="cnp-title">ПРОДЛИТЬ</div>
            <div class="form-group">

                <?php $form = ActiveForm::begin() ?>
                    <?= Html::dropDownList('time', null, [
                        1 => '1 месяц',
                        2 => '2 месяца',
                        3 => '3 месяца',
                        4 => '4 месяца',
                        5 => '5 месяцев',
                        6 => '6 месяцев',
                        7 => '7 месяцев',
                        8 => '8 месяцев',
                        9 => '9 месяцев',
                        10 => '10 месяцев',
                        11 => '11 месяцев',
                        12 => '12 месяцев',
                    ]) ?>

                <button class="button yellow">продлить</button>

                <?php ActiveForm::end(); ?>

                <div class="help-block"></div>
            </div>
        </div><!-- .cnp-col -->
    <?php endif; ?>
</div><!-- .cnp-tariff -->

<?php if ($payments): ?>
    <div class="topay">
        <div class="topay-header">К оплате</div>
        <div class="topay-value"><?= $payment_total ?> р. </div>
        <div class="topay-items">
            <?php foreach ($payments as $payment): ?>
                <div class="topay-item">
                    <div class="topay-item-title">
                        <span class="topay-item-name"><?= $payment->name ?></span>
                        <?php if ($payment->discount > 0): ?>
                            <span class="topay-item-price"><?= $payment->total ?> (скидка <?= $payment->discount ?>% - <?= $payment->price - $payment->total ?> р.)</span>
                        <?php else: ?>
                            <span class="topay-item-price"><?= $payment->total ?> р.</span>
                        <?php endif; ?>
                    </div>
                    <?= Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', ['delete-payment', 'id' => $payment->id], ['data-method' => 'POST', 'class' => 'topay-item-delete']) ?>
                </div><!-- .topay-item -->
            <?php endforeach; ?>
        </div><!-- .topay-items -->

        <?= Html::a('оплатить', ['pay'], ['data-method' => 'POST', 'class' => 'button yellow']) ?>
    </div><!-- .topay -->
<?php endif; ?>

<?php if ($user_tariff): ?>
    <div class="tariff-uses">
        <div class="tariff-uses-header">Использование тарифа</div>
        <div class="table-responsive">
            <table class="tariff-uses-table">
                <tr>
                    <th></th>
                    <th>использовано</th>
                    <th>доступно</th>
                </tr>
                <tr>
                    <td><i class="fa fa-<?= $user_tariff->tariff->count_tours == 0 ? 'times' : 'check' ?>" aria-hidden="true"></i><?= $user_tariff->tariff->getText('count_tours') ?></td>
                    <td>10 туров в каталоге</td>
                    <td>0 туров в каталоге</td>
                </tr>
                <tr>
                    <td><i class="fa fa-<?= $user_tariff->tariff->count_up_tours == 0 ? 'times' : 'check' ?>" aria-hidden="true"></i><?= $user_tariff->tariff->getText('count_up_tours') ?></td>
                    <td>5 апа туров в сутки</td>
                    <td>3 апа туров в сутки</td>
                </tr>
                <tr>
                    <td><i class="fa fa-<?= $user_tariff->tariff->count_visas == 0 ? 'times' : 'check' ?>" aria-hidden="true"></i><?= $user_tariff->tariff->getText('count_visas') ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><i class="fa fa-<?= $user_tariff->tariff->count_up_visas == 0 ? 'times' : 'check' ?>" aria-hidden="true"></i><?= $user_tariff->tariff->getText('count_up_visas') ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><i class="fa fa-<?= $user_tariff->tariff->news == 0 ? 'times' : 'check' ?>" aria-hidden="true"></i>новости, акции</td>
                    <td><?= $user_tariff->getNewsCount() ?> новость, акция в сутки</td>
                    <td><?= $user_tariff->getNewsCount() == 1 ? 0 : 1 ?> новостей, акций в сутки</td>
                </tr>
                <tr>
                    <td><i class="fa fa-<?= $user_tariff->tariff->count_responses == 0 ? 'times' : 'check' ?>" aria-hidden="true"></i><?= $user_tariff->tariff->getText('count_responses') ?></td>
                    <td><?= $user_tariff->getResponseCount() ?> откликов на заявки</td>
                    <td><?= $user_tariff->getResponseCount() > $user_tariff->tariff->count_responses ? 0 : $user_tariff->tariff->count_responses - $user_tariff->getResponseCount() ?> откликов на заявки в сутки</td>
                </tr>
                <tr>
                    <td><i class="fa fa-<?= $user_tariff->tariff->count_managers == 0 ? 'times' : 'check' ?>" aria-hidden="true"></i><?= $user_tariff->tariff->getText('count_managers') ?></td>
                    <td><?= $user_tariff->getManagersCount() ?> аккаунт менеджера</td>
                    <td><?= $user_tariff->getManagersCount() > $user_tariff->tariff->count_managers ? 0 : $user_tariff->tariff->count_managers - $user_tariff->getManagersCount() ?> аккаунтов менеджера</td>
                </tr>
                <tr>
                    <td><i class="fa fa-<?= $user_tariff->tariff->placement == 0 ? 'times' : 'check' ?>" aria-hidden="true"></i>размещение в каталоге</td>
                    <td>размещение в каталоге</td>
                    <td></td>
                </tr>
            </table><!-- .tariff-uses-table -->
        </div><!-- .table-responsive -->
    </div><!-- .tariff-uses -->
<?php endif; ?>

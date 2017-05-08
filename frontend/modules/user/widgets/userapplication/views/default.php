<?php
use common\models\Transports;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\Countries;

$countries = ArrayHelper::map(Countries::find()->all(), 'country_id', 'name');

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\LoginForm */
?>

<?php if($responsesProvider->getModels()){ ?>
    <?php \yii\widgets\Pjax::begin() ?>

    <h2>Отклики на заявку</h2>
    <ul class="tours-list">
        <?php foreach($responsesProvider->getModels() as $item) { ?>
            <li>
                <div class="general">
                    <?php if(($item->transport_type)) { ?>
                        <div class="tour-type"><i class="fa fa-<?php echo $item->transport->class ?>"></i><span><?php echo $item->transport->about ?></span></div>
                    <?php } ?>
                    <?php echo \frontend\modules\user\Module::getCountPeoples($item->childrens, $item->adults) ?>
                </div>
                <div class="tour-name">
                    <a href="/profile/messages?messager_id=<?php echo $item->manager_id ?>" class="blue"><?php echo $item->user->username ?></a>
                    <div class="tour-rate">
                        <div class="green rating-grade">5.00</div>
                        <a href="">рейтинг фирмы</a>
                    </div>
                    <p>добавлен <?php echo convertDate($item->date_update)?></p>
                </div>
                <div class="tour-destination">
                    <a href="" class="blue"><?php echo $item->country->name ?></a>
                    <a href=""><?php echo $item->city->city ?></a>
                </div>
                <div class="tour-duration">
                    <p><?php echo $item->nights ?> ночей</p>
                    <p><?php echo $item->days ?> дней</p>
                </div>
                <div class="tour-price">
                    <p><?php echo $item->price ?> <span>руб</span></p>
                </div>
            </li>
        <?php } ?>
    </ul>
    <?php echo \yii\widgets\LinkPager::widget([
            'pagination' => $responsesProvider->pagination,
        ]); ?>
    <?php \yii\widgets\Pjax::end() ?>
<?php }else{ ?>
    <h2>Откликов нету</h2>
<?php } ?>


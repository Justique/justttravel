<?php
use common\models\Countries;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this \yii\web\View */
/* @var $companions common\models\Companiones[] */
/* @var $countries common\models\Countries[] */

$this->title = 'Попутчики';
?>
<div class="content-wrapper companions">
    <h1>Попутчики<span class="companions-count head-count"><?php echo count($companions) ?></span></h1>
    <p>Найди свою компанию!</p>

    <?php /*$form = ActiveForm::begin(['method'=>'GET']); ?>
        <div class="companions-select">
            <div class="companions-select-col">
                <div class="form-group">
                    <?= Html::dropDownList('Filter[country_id]', null, $countries, [
                        'prompt' => 'Любая страна',
                        'options' => [
                            Yii::$app->request->get('Filter')['country_id'] => ['selected ' => true]
                        ]
                    ]) ?>
                </div>
            </div>
            <div class="companions-select-col">
                <div class="form-group">
                    <?= Html::dropDownList('Filter[resort_id]', null, [], [
                        'prompt' => 'Любой курорт',
                    ]) ?>
                </div>
            </div>
            <div class="companions-select-col">
                <div class="form-group">
                    <?= DatePicker::widget([
                        'name' => 'Filter[date]',
                        'language' => 'ru',
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => ['placeholder' => 'Дата'],
                    ]) ?>
                </div>
            </div>
        </div><!-- .companions-select -->

        <button type="submit" class="button yellow m-b-lg">ПОЕХАЛИ!</button>
    <?php ActiveForm::end(); */?>

    <div class="tags-container">
        <?php foreach(\common\models\Interests::getUniqInterests() as $interest): ?>
            <?php if ($interest == Yii::$app->request->get('interest_name')): ?>
                <a href="/companions">
                    <span class="checked">
                        <i class="fa fa-check"></i>
                        <?php echo $interest ?>
                        <i class="fa fa-times"></i>
                    </span>
                </a>
            <?php else: ?>
                <a href="/companions?interest_name=<?php echo $interest ?>">
                    <span>
                        <i class="fa fa-check"></i>
                        <?php echo $interest ?>
                        <i class="fa fa-times"></i>
                    </span>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <div class="companions-container">
        <?php foreach($companions as $item){ ?>
        <article>
            <div class="main-info">
                <div class="creds">
                    <a href="/profile/messages?messager_id=<?php echo $item->user_id ?>">
                        <?php
                        echo \yii\helpers\Html::img(
                            Yii::$app->glide->createSignedUrl([
                                'glide/index',
                                'path' => getAvatar($item->user_id),
                                'w' => 200,
                                'q' => getenv('IMAGE_QUALITY')
                            ], true)
                        );
                        ?>
                        <i class="fa fa-comment"></i>
                    </a>
                    <div>
                        <p class="name"><span><?php echo $item->myCompaniones->firstname." ".$item->myCompaniones->lastname ?></span><span class="age <?php echo \common\models\Companiones::getClassGender($item->myCompaniones->gender) ?>"><?php echo getFullYears($item->myCompaniones->byear, $item->myCompaniones->bmonth, $item->myCompaniones->bday) ?></span><span class="location"><?php echo Countries::getCountry($item->myCompaniones->country)?>, <?php echo \common\models\Cities::getCity($item->myCompaniones->country)?></span></p>
                        <div><i class="fa <?php echo $item->gender->class_gender ?>"></i>Ищу в попутчики <?php echo $item->gender->gender ?></div>
                        <div><i class="fa fa-user"></i>Возраст от <?php echo $item->age_with ?> до <?php echo $item->age_to ?> лет</div>
                    </div>
                </div>
                <div class="target">
                    <p class="destination">в <?php echo $item->travel_location ?></p>
                    <p><span>Цель поездки:</span> <?php echo $item->purpose_travel ?></p>
                    <p><span>О себе:</span> <?php echo $item->about_me ?></p>
                    <p><span>О попутчике:</span> <?php echo $item->about_traveler ?></p>
                </div>
            </div>
            <?php foreach($item->tagLinks as $link){ ?>
                <a href="#" class="tag"><?php echo $link ?> </a>
            <?php } ?>
        </article>
        <?php } ?>
       <?php echo LinkPager::widget([
        'pagination' => $pages,
        ]); ?>
    </div>
</div>
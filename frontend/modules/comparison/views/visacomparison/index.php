<?php
use yii\widgets\LinkPager;

?>
<div class="comparison-default-index">
    <div class="content-wrapper with-counter">
        <h1>Визы для сравнения <span class="country-count"><?php echo  count($models) ?></span></h1>

<?php
//$form = ActiveForm::begin([
//    'id'=>'tour-country-filter',
//    'options'=>[
//        'class'=>'regular-form'
//    ]
//]);
//$modelCountries = new Countries();
//$countries = Countries::find()->all();
//$items = ArrayHelper::map($countries, 'country_id', 'name');
//$option = '';
//if(isset( yii::$app->request->get('ToursSearch')['country_to_id'])){
//    $option = [yii::$app->request->get('ToursSearch')['country_to_id'] => ['selected ' => true ]];
//}
//echo $form->field($modelCountries, 'searchCountries')->dropDownList($items, ['prompt'=>'Выберете страну',   'options' =>$option])->label(false);
//ActiveForm::end();
//?>
<p class="sort">Сортировать по:
    <?php echo $sort->link('date_create')?>
    <!----><?php echo $sort->link('price')?>
</p>
<ul class="tours-list">
    <?php foreach($models as $model){?>
        <li  class="green">
            <div class="visa-name" disabled>
                <a href="/visa/<?php echo $model->visa->slug ?>" class="blue"><?php echo $model->visa->name ?></a>
                <div class="tour-rate">
                    <span class="rating-grade <?php echo \frontend\modules\tourfirms\Module::getStyleForReviews((float)$model->visa->tourfirm->rating) ?>"><?php echo (float)$model->visa->tourfirm->rating ?></span>
                    <?php if(user()->id){ ?>
                        <a class="ajax-link" href="/tourfirms/isvotestourfirm?tourfirm_id=<?php echo $model->visa->tourfirm_id ?>">рейтинг фирмы</a>
                    <?php }else{ ?>
                        <a class="login" href="#">рейтинг фирмы</a>
                    <?php } ?>
                </div>
                <p><?php echo convertDate($model->visa->date_update) ?></p>
            </div>
            <div class="visa-destination">
                <a href="/visa?VisaSearch[country_id]=<?php echo $model->visa->country_id ?>" class="blue"><?php echo \common\models\Countries::getCountry($model->visa->country_id); ?></a>
                <a href="/visa?VisaSearch[city_id]=<?php echo $model->visa->city_id ?>"><?php echo \common\models\Cities::getCity($model->visa->city_id); ?></a>
            </div>
            <div class="visa-type">
                <p><?php echo $model->visa->type ?></p>
                <p><?php echo $model->visa->type_time ?></p>
            </div>
            <div class="visa-desc">
                <p class="req-time"><i class="fa fa-clock-o"></i>Срок оформления: <strong><?php echo $model->visa->period; ?> дней</strong></p>
                <p class="req-docs"><i class="fa fa-folder-o"></i>Документы: <?php echo $model->visa->documents; ?>...</p>
            </div>
            <div class="tour-price">
                <p><?php echo $model->visa->price; ?> <span>руб.</span></p>
                <?php if(!user()->id){ ?>
                    <div>
                        <a href="#" class="login"><div class="tour-compare plus"></div></a>
                        <div class="tour-like"><a href="#" class="login"><div class="heart"></div></a><span></span></div>
                    </div>
                <?php }else{ ?>
                    <div>
                        <a href="/visa/comparison?comparison_save=1&visa_id=<?php echo $model->id ?>&tourfirm_id=<?php echo $model->tourfirm_id ?>"class="ajax-link"><div class="tour-compare"></div></a>
                        <?php if(\frontend\modules\visa\Module::getFavorits($model->id)){ ?>
                            <div class="tour-like"><a href="/visa/favorits?save=0&visa_id=<?php echo $model->id ?>" class="ajax-link"><div class="heart full"></div></a><span></span></div>
                        <?php }else{?>
                            <div class="tour-like"><a href="/visa/favorits?save=1&visa_id=<?php echo $model->id ?>" class="ajax-link"><div class="heart"></div></a><span></span></div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <?php if($countComp = \frontend\modules\visa\Module::getComparison($model->id)){ ?>
                    <span class="tour-comparison-popup" style="display: block" >
                    <a href="/comparison/visa"><span><?php echo $countComp ?></span></a>
                    <div><a href="/visa/comparison?comparison_save=0&visa_id=<?php echo $model->id ?>" class="ajax-link"><i class="fa fa-trash"></i></a></div>
        </span>
                <?php } ?>
            </div>

        </li>
    <?php } ?>
</ul>
        <?php echo LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>
    </div>
</div>


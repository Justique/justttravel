<?php
/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('frontend', 'User Settings');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="messages">
<div class="head-symbol"><i class="fa fa-commenting"></i></div>
<h1><?php echo Yii::t('frontend', 'Сообщения') ?></h1>

<?= \frontend\components\MyPrivateMessageKushalpandyaWidget::widget() ?>
<?php
$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $(".message-user-list li.contact active a").click(); }, 1000);
});
JS;
$this->registerJs($script);
?>
<script>
    <?php $number = yii::$app->request->get('messager_id') ?>
    function startInterval() {
        $(".message-user-list li[data-user='<?php echo $number ?>']").trigger('click');
    }
    var intervalID = setInterval(startInterval,1000);
    setTimeout(function() {
        clearInterval(intervalID);
        var scroll_el = $(".message-user-list li[data-user='<?php echo $number ?>']").prev().prev().prev().prev().prev().prev().prev().prev().prev();
        $('ul.message-user-list').animate({scrollTop: $(scroll_el).offset().top}, 500);
    }, 1000);
</script>
</div>

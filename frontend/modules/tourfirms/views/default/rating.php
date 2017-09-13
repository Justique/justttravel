<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
$this->title = $model->name . ' - оставить отзыв';
?>
<style>
    .img_button_upload{
        display:none!important;
    }
</style>
<script>
    $(document).ready(function(){
        $('#load').click(function() {
            $('.img_button_upload .upload-kit-item .remove').click();
            $('#w1').click();
        });
    });
</script>
<section>
    <div class="content-wrapper graduation-container">
        <h1>Мой отзыв о <?php echo $model->name ?></h1>
        <?php $form = ActiveForm::begin(['action'=>'/tourfirm/createreviews','options'=>['class'=>'graduation-form ajax-form']]); ?>
        <div style="display: none;">
            <?= $form->field($tourfirmsReviews, 'user_id')->hiddenInput(['value'=>user()->id])->label(false) ?>
            <?= $form->field($tourfirmsReviews, 'tourfirm_id')->hiddenInput(['value'=>$model->id])->label(false) ?>
            <?= $form->field($tourfirmsReviews, 'slug')->hiddenInput(['value'=>$model->slug])->label(false) ?>
            <?= $form->field($tourfirmsReviews, 'status')->hiddenInput(['value'=>0])->label(false) ?>
        </div>
            <div class="graduation">
                    <span>Ваша оценка</span>
                    <input id="grade-1" type="radio" name="TourfirmsReviews[vote]" value="1">
                    <label for="grade-1">1</label>
                    <input id="grade-2" type="radio" name="TourfirmsReviews[vote]" value="2">
                    <label for="grade-2">2</label>
                    <input id="grade-3" type="radio" name="TourfirmsReviews[vote]" value="3">
                    <label for="grade-3">3</label>
                    <input id="grade-4" type="radio" name="TourfirmsReviews[vote]" value="4">
                    <label for="grade-4">4</label>
                    <input id="grade-5" type="radio" name="TourfirmsReviews[vote]" value="5">
                    <label for="grade-5">5</label>
            </div>
         <?php if(!$reviews){ ?>
            <?php $nameButton = 'отправить отзыв'; ?>
             <div class="img_button_upload">
                 <?php
                 echo $form->field($tourfirmsReviews, 'thumbnail')->widget(
                     \trntv\filekit\widget\Upload::className(),
                     [
                         'url' => ['/file-storage/upload'],
                         'maxFileSize' => 5000000, // 5 MiB
                     ]);
                 ?>
             </div>

            <?= $form->field($tourfirmsReviews, 'comment')->textarea(['cols'=>30, 'rows'=>10,'placeholder'=>'Текст отзыва...', 'required'=>true])->label(false) ?>
            <a href="" id="load" class="yellow button"><i class="fa fa-picture-o"></i>загрузить документ</a>

        <?php }else{ ?>
            <?php $nameButton = 'отправить оценку'; ?>
        <?php } ?>
        <?= Html::submitButton($nameButton, ['class' => '']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</section>
<?php

use frontend\models\ContactForm;
use frontend\modules\user\widgets\login\SWidget;
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 24.12.2015
 * Time: 16:51
 */
$model = new ContactForm;
?>
<div class="w_popup login_popup">
    <i class="fa fa-times popup_close"></i>
    <div class="popup_head">Авторизация</div>
    <?php echo SWidget::widget(); ?>
</div>

<div class="w_popup feedback_popup mini-popup">
    <i class="fa fa-times popup_close"></i>
    <div class="beta__popup">
        <?= $this->render('//site/_feedback', ['model' => $model])?>
    </div>

</div>
<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\modules\user\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['user/sign-in/email-confirm', 'token' => $user->email_confirm_token]);
?>

Здравствуйте, <?= Html::encode($user->username) ?>!<br><br>

Для подтверждения адреса пройдите по ссылке:<br><br>

<?= Html::a(Html::encode($confirmLink), $confirmLink) ?><br><br>

Если Вы не регистрировались на нашем сайте, то просто удалите это письмо.<br><br>
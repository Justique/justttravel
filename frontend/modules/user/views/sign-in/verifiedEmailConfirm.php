<?php
use yii\helpers\Html;
use yii\helpers\Url;


$this->title = Yii::t('frontend', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="register-page">
    <div class="content-wrapper text-center">
        <h1>Подтверждение Email пользователя</h1>
        <?php switch($result){
            case 'confirm':?>
            <p><br></p>
            <p>Спасибо! Ваш Email успешно подтверждён.</p>
            <p>Теперь Вы можете воспользоваться личным кабинетом для дальнейшего использования сервисов сайта.</p>
        <?php break;
            case 'error': ?>
            <p><br></p>
            <p>Ошибка подтверждения Email.</p>
            <p>Если Вы перешли по ссылке из письма, и ошибка всеравно повторяется,
                то обратитесь к администрации сайта, мы постараемся вам помочь в решении вашей проблемы.</p>
        <?php break;
            case 'warning':?>
            <p><br></p>
            <p>На ваш почтовый ящик, указанный при регистрации, выслано письмо для подтверждения указанного email.</p>
            <p>Воспользуйтесь ссылкой в письме для активации зарегистрированного аккаунта и сделать доступными все сервисы сайта.</p>
        <?php break;
            default:?>
            <p>Что-то вы не то делаете господа.</p>
        <?php break;
        }?>
    </div>
</section>
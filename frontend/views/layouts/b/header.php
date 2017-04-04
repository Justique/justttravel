<?php

use common\models\ToursComparison;
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 24.12.2015
 * Time: 16:52
 */
$comparision = 0;

if(user()->id) {
    $comparision = ToursComparison::find()->where(['user_id'=>user()->id])->count();
    switch($comparision){
        case 1:
            $str = ' тур';
            break;
        case ($comparision > 1 && $comparision < 5):
            $str = ' тура';
            break;
        default:
            $str = ' туров';
    }
    if($comparision) {
        $comparision .= $str;
    }
    
}

?>
<header>
    <div class="wrapper">
        <a href="/" class="logo">
            <i class="feedback-popup-open"></i>
            <div></div>
            <span>все туры Беларуси</span>
		</a>
        <div class="burger-trigger"></div>
        <nav>
            <a href="<?=url('/tours') ?>" title="">Туры</a>
            <a href="<?=url('/tourfirms') ?>" title="">Турфирмы</a>
            <a href="<?=url('/visa') ?>" title="">Визы</a>
            <a href="<?=url('/countries') ?>" title="">Страны</a>
            <a href="<?=url('/companions') ?>" title="">Попутчики</a>
            <a href="<?=url('/article') ?>" title="">Новости</a>
        </nav>
        <div class="login-buttons">
            <?php if (!user()->getIsGuest()) { ?>
                <?php echo l('Личный кабинет', \frontend\modules\user\Module::ProfileUrl()) ?>
                <?php echo l('Выход', \frontend\modules\user\Module::LogoutUrl()) ?>
            <?php } else { ?>
                <?php echo l('Регистрация', \frontend\modules\user\Module::SignUpUrl()) ?>
                <?php echo l('Вход', '#', ['class' => 'login']) ?>
            <?php } ?>
        </div>
    </div>
</header>
<div class="header-spacer"></div>
<?php if($comparision != 0): ?>
    <div class="message-absolute-top yellow">
        <a href="/comparison/tour">
            Вы добавили  <?= $comparision ?> в сравнение
        </a>
    </div>
<?php endif; ?>
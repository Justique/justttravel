<?php
use frontend\helpers\MetrikaHelper;
?>
<footer>
    <div class="wrapper">
        <div class="statistics">
            <!-- div class="logo">
                <a href="#">
                    <div></div>
                    <span>все туры Беларуси<span> 2016</span></span>
                </a>
            </div -->
			<a href="/" class="logo">
			<i class="feedback-popup-open"></i>
            <div></div>
            <span>все туры Беларуси</span>
			</a>
            <p><span><?= MetrikaHelper::getUsersCount() ?></span> посещения вчера</p>
            <p><span><?= MetrikaHelper::getPageViews() ?></span> просмотров вчера</p>
        </div>
        <nav>
            <ul>
                <li><a href="/page/about">О портале</a></li>
                <li><a href="/page/reklam">Реклама</a></li>
                <li><a href="/tariffs">Тарифы</a></li>
                <li><a href="/page/pravila">Правила</a></li>
                <li><a href="/page/kontakt">Контакты</a></li>
            </ul>
            <ul>
                <li><a href="/tours">Туры</a></li>
                <li><a href="/tourfirms">Турфирмы</a></li>
                <li><a href="/companions">Попутчики</a></li>
                <li><a href="/countries">Страны</a></li>
                <li><a href="/visa">Визы</a></li>
            </ul>
        </nav>
        <div id="counters" class="sponsors">
            <a href="#" class="akavita"></a>
        </div>
    </div>
</footer>

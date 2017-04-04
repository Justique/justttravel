<?php
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 25.12.2015
 * Time: 13:45
 * @var $data common\models\Article
 */

foreach($data as $news){ ?>
    <a href="<?php echo $news->viewurl ?>" class="grid-item grid-item--double-width">
        <div class="container">
            <span class="label-news">новости</span>
            <span class="label-date"><?php echo $news->date; ?></span>
        </div>
        <h3><?= $news->getCF('title'); ?></h3>
        <br>
        <p><?= $news->getAnnounce(190) ?></p>
    </a>
<?php } ?>
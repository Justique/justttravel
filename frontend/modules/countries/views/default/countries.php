
<?php
?>
<section class="all-countries">
    <div class="content-wrapper with-counter">
        <h1>Все страны<span class="country-count"><?php echo count($model) ?></span></h1>
        <p>Все страны в нашем каталоге туров</p>
        <div class="countries-container">
            <?php foreach(array_chunk($alphavit,11) as $letters){?>
                <ul>
                <?php foreach($letters as $letter){?>
                    <li class="list-head"><?php  echo $letter ?></li>
                    <?php foreach($model as $item){
                        if($letter === mb_substr($item->name,0,1,"UTF-8")){ ?>
                            <li><a href="/tours?ToursSearch[country_to_id]=<?php echo $item->country_id ?>"><?php echo $item->name ?></a></li>
                        <?php } ?>
                    <?php } ?>
            <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
</section>
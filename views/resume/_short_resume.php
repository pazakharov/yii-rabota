<?php
use yii\helpers\Url;
?>
<div class="vakancy-page-block company-list-search__block resume-list__block p-rel mb16">
    <div class="company-list-search__block-left">
        <div class="resume-list__block-img mb8">
            <img src="<?=$model->foto?>" alt="profile">
        </div>
    </div>
    <div class="company-list-search__block-right">
        <div class="mini-paragraph cadet-blue mobile-mb12">Обновлено
            <?=\Yii::$app->formatter->asDateTime($model->updated_at) ?></div>
        <h3 class="mini-title mobile-off"><?=$model->specialization->name?></h3>
        <div class="d-flex align-items-center flex-wrap mb8 ">
            <span class="mr16 paragraph"><?=$model->zp?> ₽</span>
            <span class="mr16 paragraph"><?=(isset($model->lastopyt->position))?'Опыт работы '.$model->stag:'Без опыта'?></span>
            <span class="mr16 paragraph"><b><?=$model->age?></b></span>
            <span class="mr16 paragraph"><?=$model->city?></span>
        </div>
        <p class="paragraph tbold">
        <?php if(isset($model->lastopyt->position)){
            echo 'Последнее место работы';}?>
        </p>
    </div>
    <div class="company-list-search__block-middle">
       
        <p class="paragraph mb16 mobile-mb32">
            <?php if(isset($model->lastopyt->position)){echo $model->lastopyt->position;} ?>
            <?php if(isset($model->lastopyt->organization)){echo ' в "'.$model->lastopyt->organization.'"';} ?>
            <?php if(isset($model->lastopyt->year1)){echo Yii::$app->formatter->asDate('01-'.$model->lastopyt->month1.'-'.$model->lastopyt->year1,"LLLL YYYY").' -';} ?>
            <?php if(isset($model->lastopyt->year1)){echo Yii::$app->formatter->asDate('01-'.$model->lastopyt->month2.'-'.$model->lastopyt->year2,"LLLL YYYY");} ?>
            <a class="nav-link" href="<?=Url::toRoute(['resume/view', 'id' => $model->id])?>">Подробнее</a>
        </p>
        
    </div>
</div>

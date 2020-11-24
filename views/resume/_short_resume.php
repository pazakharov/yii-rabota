<?php $op = $model->getOpyts()->orderBy('id DESC')->limit(1)->one() ;?>
<div class="vakancy-page-block company-list-search__block resume-list__block p-rel mb16">
    <div class="company-list-search__block-left">
        <div class="resume-list__block-img mb8">
            <img src="<?=$model->foto?>" alt="profile">
        </div>
    </div>
    <div class="company-list-search__block-right">
        <div class="mini-paragraph cadet-blue mobile-mb12">Обновлено
            <?=\Yii::$app->formatter->asDate($model->updated_at, 'd:m:Y H:M') ?></div>
        <h3 class="mini-title mobile-off"><?=$model->specialization->name?></h3>
        <div class="d-flex align-items-center flex-wrap mb8 ">
            <span class="mr16 paragraph"><?=$model->zp?> ₽</span>
            <span class="mr16 paragraph"></span>
            <span class="mr16 paragraph"><b><?=$model->age?></b></span>
            <span class="mr16 paragraph"><?=$model->city?></span>
        </div>
        <p class="paragraph tbold">
        <?php if(isset($op->position)){echo 'Последнее место работы';}else{echo 'Без опыта';} ?>
        </p>
    </div>
    <div class="company-list-search__block-middle">
       
        <p class="paragraph mb16 mobile-mb32">
            <?php if(isset($op->position)){echo $op->position;} ?>
            <?php if(isset($op->organization)){echo ' в "'.$op->organization.'"';} ?>
            <?php if(isset($op->year1)){echo $op->year1.' -';} ?>
            <?php if(isset($op->year2)){echo $op->year2;} ?>
        </p>
    </div>
</div>

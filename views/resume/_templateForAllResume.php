<?php

/**
 * Шаблон вывода одного резюме в allResume
 * @var $model app\models\Resume 
 */

use yii\helpers\Url;
?>
<div class="vakancy-page-block company-list-search__block resume-list__block p-rel mb16">
    <div class="company-list-search__block-left">
        <div class="resume-list__block-img mb8">
            <img src="<?= $model->foto ?>" alt="profile">
        </div>
    </div>
    <div class="company-list-search__block-right">
        <div class="mini-paragraph cadet-blue mobile-mb12">Обновлено
            <?= \Yii::$app->formatter->asDateTime($model->updated_at) ?></div>
        <h3 class="mini-title mobile-off"><?= $model->specialization->name ?></h3>
        <div class="d-flex align-items-center flex-wrap mb8 ">
            <span class="mr16 paragraph"><?= $model->zp ?> ₽</span>
            <span class="mr16 paragraph"><?= (isset($model->lastexperience->position)) ? 'Опыт работы ' . $model->stag : 'Без опыта' ?></span>
            <span class="mr16 paragraph"><b><?= $model->age ?></b></span>
            <span class="mr16 paragraph"><?= $model->city ?></span>
        </div>
        <p class="paragraph tbold">
            <?php if (isset($model->lastexperience->position)) {
                echo 'Последнее место работы';
            } ?>
        </p>
    </div>
    <div class="company-list-search__block-middle">

        <p class="paragraph mb16 mobile-mb32">
            <?php if (isset($model->lastexperience->position)) {
                echo $model->lastexperience->position;
            } ?>
            <?php if (isset($model->lastexperience->organization)) {
                echo ' в "' . $model->lastexperience->organization . '"';
            } ?>
            <?php if (isset($model->lastexperience->year1)) {
                echo Yii::$app->formatter->asDate('01-' . $model->lastexperience->month1 . '-' . $model->lastexperience->year1, "LLLL YYYY") . ' -';
            } ?>
            <?php if (isset($model->lastexperience->year1)) {
                echo Yii::$app->formatter->asDate('01-' . $model->lastexperience->month2 . '-' . $model->lastexperience->year2, "LLLL YYYY");
            } ?>
            <a class="nav-link" href="<?= Url::toRoute(['resume/view', 'id' => $model->id]) ?>">Подробнее</a>
        </p>

    </div>
</div>
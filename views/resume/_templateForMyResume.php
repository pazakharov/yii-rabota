<?php

/**
 * Шаблон вывода одного резюме в myResume
 * @var $model app\models\Resume 
 */

use yii\helpers\Url;

?>
<div class="vakancy-page-block my-vacancies-block p-rel mb16">
    <div class="row">
        <div class="my-resume-dropdown dropdown show mb8">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="images/dots.svg" alt="dots">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="<?= Url::toRoute(['resume/update', 'id' => $model->id]) ?>">Редактировать</a>
                <a class="dropdown-item" href="<?= Url::toRoute(['resume/delete', 'id' => $model->id]) ?>">Удалить</a>
            </div>
        </div>

        <div class="col-xl-12 my-vacancies-block__left-col d-flex mb16">
            <div class="resume-list__block-img align-self-start mb8">
                <img src="<?= $model->foto ?>" alt="profile">
            </div>
            <div class="d-flex ml8 align-items-start flex-wrap flex-column mb8 ">
                <h2 class="mini-title mb8"><?= $model->specialization->name ?></h2>
                <h5 class="mini-title mb8">
                    <div class="paragraph mr16"><strong><?= $model->first_name ?> <?= $model->middle_name ?> <?= $model->last_name ?></strong></div>
                </h5>
                <span class="mr16 paragraph"><?= $model->zp ?> ₽</span>
                <span class="mr16 paragraph"><?= (isset($model->lastexperience->position)) ? 'Опыт работы ' . $model->stag : 'Без опыта' ?></span></span>
                <span class="mr16 paragraph"><?= $model->city ?></span>
            </div>
        </div>
        <div class="col-xl-12 d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex flex-wrap mobile-mb12">
                <a class="mr16" href="<?= Url::toRoute(['resume/view', 'id' => $model->id]) ?>">Открыть</a>
            </div>
            <span class="mini-paragraph cadet-blue">Опубликовано <?= Yii::$app->formatter->asDateTime($model->created_at) ?>
            </span>
        </div>
    </div>
</div>
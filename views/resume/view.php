<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $resume app\models\Resume */

$this->title = $resume->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Резюме'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="content p-rel">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="mt8 mb32"><a href="<?= Url::toRoute('resume/my-resume') ?>"><img src="images/blue-left-arrow.svg" alt="arrow"> Все резюме </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-5 mobile-mb32">
                <div class="profile-foto resume-profile-foto"><img src="<?= $resume->foto ?>" alt="profile-foto">
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="main-title d-md-flex justify-content-between align-items-center mobile-mb16">
                    <?= $resume->specialization->name ?>
                </div>
                <div class="paragraph-lead mb16">
                    <span class="mr24"><?= $resume->zp ?></span>
                    <span><?= (isset($resume->lastexperience->position)) ? 'Опыт работы ' . $resume->stag : 'Без опыта' ?></span>
                </div>
                <div class="profile-info__block company-profile-info__block mb8">
                    <div class="profile-info__block-left company-profile-info__block-left">Имя
                    </div>
                    <div class="profile-info__block-right company-profile-info__block-right"> <?= $resume->first_name ?>
                        <?= $resume->middle_name ?>
                        <?= $resume->last_name ?></div>
                </div>
                <div class="profile-info__block company-profile-info__block mb8">
                    <div class="profile-info__block-left company-profile-info__block-left">Возраст
                    </div>
                    <div class="profile-info__block-right company-profile-info__block-right"><?= $resume->age ?></div>
                </div>

                <div class="profile-info__block company-profile-info__block mb8">
                    <div class="profile-info__block-left company-profile-info__block-left">Занятость</div>
                    <div class="profile-info__block-right company-profile-info__block-right">
                        <?= $resume->getEmploymentNamesStr(); ?>
                    </div>
                </div>
                <div class="profile-info__block company-profile-info__block mb8">
                    <div class="profile-info__block-left company-profile-info__block-left">График работы
                    </div>
                    <div class="profile-info__block-right company-profile-info__block-right">
                        <?= $resume->getSchedulesNamesStr(); ?>
                    </div>
                </div>
                <div class="profile-info__block company-profile-info__block mb8">
                    <div class="profile-info__block-left company-profile-info__block-left">Город проживания
                    </div>
                    <div class="profile-info__block-right company-profile-info__block-right"><?= $resume->city ?></div>
                </div>
                <div class="profile-info__block company-profile-info__block mb8">
                    <div class="profile-info__block-left company-profile-info__block-left">
                        Электронная почта
                    </div>
                    <div class="profile-info__block-right company-profile-info__block-right"><a href="#"><?= $resume->mail ?></a></div>
                </div>
                <div class="profile-info__block company-profile-info__block mb8">
                    <div class="profile-info__block-left company-profile-info__block-left">
                        Телефон
                    </div>
                    <div class="profile-info__block-right company-profile-info__block-right"><a href="#"><?= $resume->phone ?></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="devide-border mb32 mt50"></div>
            <div class="tabs mb50">
                <div class="tabs__content active">
                    <div class="row">
                        <div class="col-lg-10">

                            <div class="row mb16">
                                <div class="col-lg-12">
                                    <h3 class="heading mb16">
                                        <?= (isset($resume->lastexperience->position)) ? 'Опыт работы ' . $resume->stag : 'Без опыта' ?>
                                    </h3>
                                </div>
                            </div>

                            <?php foreach ($resume->experiencs as $experience) :  ?>
                                <div class="row mb16">
                                    <div class="col-md-4 mb16">
                                        <div class="paragraph tbold mb8"><?php echo $experience->month1; ?> <?php echo $experience->year1; ?> - <?php echo $experience->month2; ?> <?php echo $experience->year2; ?></div>
                                        <div class="mini-paragraph"></div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="paragraph tbold mb8"><?php echo $experience->organization; ?></div>
                                        <div class="paragraph tbold mb8"><?php echo $experience->position; ?>
                                        </div>
                                        <div class="paragraph"><?php echo $experience->duties; ?>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>

                        </div>
                        <div class="col-lg-7">
                            <div class="company-profile-text mb64">
                                <h3 class="heading mb16">Обо мне</h3>
                                <?php echo $resume->about; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
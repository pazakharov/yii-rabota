<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\Resume;
use yii\widgets\ListView;
use \app\models\Specializations;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ResumeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Резюме');
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="header-search">
    <div class="container">
        <div class="header-search__wrap">
            <form style="margin:0" class="header-search__form">
                <a href="#"><img src="images/dark-search.svg" alt="search" class="dark-search-icon header-search__icon"></a>
                <input class="header-search__input" type="text" placeholder="Поиск по резюме и навыкам">
                <button type="button" class="blue-btn header-search__btn">Найти</button>
            </form>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <h1 class="main-title mt24 mb16"><?= $this->title ?></h1>
        <button class="vacancy-filter-btn">Фильтр</button>
        <div class="row">
            <div class="col-lg-9 desctop-992-pr-16">

                <?php Pjax::begin(['id' => 'content_pjax']); ?>

                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_templateForAllResume',
                    'itemOptions' => ['tag' => false],
                    'layout' =>  $this->render('_summary'),
                ]); ?>

                <?php Pjax::end(); ?>

            </div>

            <div class="col-lg-3 desctop-992-pl-16 d-flex flex-column vakancy-page-filter-block vakancy-page-filter-block-dnone">
                <form id="searchform" action="<?= Url::current() ?>">
                    <div class="vakancy-page-filter-block__row mobile-flex-992 mb24 d-flex justify-content-between align-items-center">
                        <div class="heading">Фильтр</div>
                        <img class="cursor-p" src="images/big-cancel.svg" alt="cancel">
                    </div>

                    <?php
                    Pjax::begin(['id' => 'links_pjax']);
                    ?>

                    <div class="signin-modal__switch-btns-wrap resume-list__switch-btns-wrap mb16">
                        <a href="<?= Url::current(['sex' => null]) ?>" class="signin-modal__switch-btn <?= !isset($params['sex']) ? 'active' : '' ?>">Все</a>
                        <a href="<?= Url::current(['sex' => '1']) ?>" class="signin-modal__switch-btn <?= isset($params['sex']) && $params['sex'] == '1' ? 'active' : '' ?>">Мужчины</a>
                        <a href="<?= Url::current(['sex' => '2']) ?>" class="signin-modal__switch-btn <?= isset($params['sex']) && $params['sex'] == '2' ? 'active' : '' ?>">Женщины</a>
                    </div>
                    <?php Pjax::end(); ?>


                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Город</div>
                        <div class="citizenship-select">
                            <?= Html::dropDownList('city', isset($params['city']) ? $params['city'] : '', $cities, ['class' => 'nselectlist-form formelement', 'id' => 'citylist', 'prompt' => '']) ?>
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Зарплата</div>
                        <div class="d-flex">
                            <?= Html::input('text', 'zp1', isset($params['zp1']) ? $params['zp1'] : '', ['class' => 'dor-input w100 ', 'placeholder' => 'От', 'id' => 'zp1']) ?><img class="rub-icon" src="images/rub-icon.svg" alt="rub-icon">
                            <?= Html::input('text', 'zp2', isset($params['zp2']) ? $params['zp2'] : '', ['class' => 'dor-input  w100', 'placeholder' => 'До', 'id' => 'zp2']) ?><img class="rub-icon" src="images/rub-icon.svg" alt="rub-icon">
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Специализация</div>
                        <div class="citizenship-select">
                            <?= Html::dropDownList('specialization_id', isset($params['specialization_id']) ? $params['specialization_id'] : '', Specializations::find()->Select(['name', 'id'])->indexBy('id')->column(), ['prompt' => 'Выберете специализацию..', 'id' => 'specialization', 'class' => 'nselectlist-form']) ?>
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Возраст</div>
                        <div class="d-flex">
                            <?= Html::input('text', 'birthdate1', isset($params['birthdate1']) ? $params['birthdate1'] : '', ['class' => 'dor-input w100 ', 'placeholder' => 'От', 'id' => 'birthdate1']) ?><img class="rub-icon" src="images/rub-icon.svg" alt="rub-icon">
                            <?= Html::input('text', 'birthdate2', isset($params['birthdate2']) ? $params['birthdate2'] : '', ['class' => 'dor-input  w100', 'placeholder' => 'До', 'id' => 'birthdate2']) ?><img class="rub-icon" src="images/rub-icon.svg" alt="rub-icon">
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Опыт работы</div>
                        <div class="profile-info">

                            <?= Html::checkboxList(
                                'experience_dev',
                                isset($params['experience_dev']) ? $params['experience_dev'] : '',
                                [
                                    '1' => 'Без опыта',
                                    '2' => 'от 1 года до 3 лет',
                                    '3' => 'от 3 лет до 6 лет',
                                    '4' => 'Свыше 6 лет'

                                ],
                                [
                                    'item' => function ($index, $label, $name, $checked, $value) {
                                        $ch = '';
                                        if ($checked == 1) {
                                            $ch = 'checked';
                                        }

                                        return '<div class="form-check d-flex">
                                            <input name="' . $name . '" type="checkbox" class="form-check-input"
                                                value="' . $value . '" id="zCheck' . $index . '" ' . $ch . '>
                                            <label class="form-check-label" for="zCheck' . $index . '"></label>
                                            <label for="zCheck' . $index . '"
                                                class="profile-info__check-text job-resolution-checkbox">' . $label .
                                            '</label>
                                        </div>';
                                    },
                                    'id' => 'experience_dev',
                                ]
                            ); ?>


                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Тип занятости</div>
                        <div class="profile-info">
                            <?= Html::checkboxList(
                                'employment',
                                isset($params['employment']) ? $params['employment'] : '',
                                Resume::getAvailibleEmployments(),
                                [
                                    'item' => function ($index, $label, $name, $checked, $value) {
                                        $ch = '';
                                        $index = 'employment' . $index;
                                        if ($checked == 1) {
                                            $ch = 'checked';
                                        }

                                        return '<div class="form-check d-flex">
                                            <input name="' . $name . '" type="checkbox" class="form-check-input"
                                                value="' . $value . '" id="zCheck' . $index . '" ' . $ch . '>
                                            <label class="form-check-label" for="zCheck' . $index . '"></label>
                                            <label for="zCheck' . $index . '"
                                                class="profile-info__check-text job-resolution-checkbox">' . $label .
                                            '</label>
                                        </div>';
                                    },
                                    'id' => 'employment',
                                ]
                            ); ?>
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">График работы</div>
                        <div class="profile-info">

                            <?= Html::checkboxList(
                                'schedule',
                                isset($params['schedules']) ? $params['schedules'] : '',
                                Resume::getAvailibleSchedules(),
                                [
                                    'item' => function ($index, $label, $name, $checked, $value) {
                                        $ch = '';
                                        $index = 'schedule' . $index;
                                        if ($checked == 1) {
                                            $ch = 'checked';
                                        }

                                        return '<div class="form-check d-flex">
                                            <input name="' . $name . '" type="checkbox" class="form-check-input"
                                                value="' . $value . '" id="zCheck' . $index . '" ' . $ch . '>
                                            <label class="form-check-label" for="zCheck' . $index . '"></label>
                                            <label for="zCheck' . $index . '"
                                                class="profile-info__check-text job-resolution-checkbox">' . $label .
                                            '</label>
                                        </div>';
                                    },
                                    'id' => 'schedule',
                                ]
                            ); ?>

                        </div>
                    </div>
            </div>
            <div class="vakancy-page-filter-block__row vakancy-page-filter-block__show-vakancy-btns mb24 d-flex flex-wrap align-items-center mobile-jus-cont-center">
                <button type="submit" class="link-orange-btn orange-btn mr24 mobile-mb12" href="#">Показать
                    <span>1 230</span>
                    вакансии</button>
                <a href="#">Сбросить все</a>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
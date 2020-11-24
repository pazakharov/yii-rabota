<?php
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\Html;
use \app\models\Specializations;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ResumeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Резюме');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Pjax::begin(); ?>
<div class="header-search">
        <div class="container">
            <div class="header-search__wrap">
                <form style="margin:0" class="header-search__form">
                    <a href="#"><img src="images/dark-search.svg" alt="search"
                                     class="dark-search-icon header-search__icon"></a>
                    <input class="header-search__input" type="text" placeholder="Поиск по резюме и навыкам">
                    <button type="button" class="blue-btn header-search__btn">Найти</button>
                </form>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <h1 class="main-title mt24 mb16"><?=$this->title?></h1>
            <button class="vacancy-filter-btn">Фильтр</button>
            <div class="row">
                <div class="col-lg-9 desctop-992-pr-16">
                    
                    
                    <?=ListView::widget([
                                            'dataProvider' => $dataProvider,
                                            'itemView' => '_short_resume',
                                            'itemOptions' => [
                                                'tag' => false,

                                            ],
                                            'pager' => [
                                                'pagination'=> [
                                                    'pageSize' => 5,
                                                    
                                                ]
                                            ],
                                            'layout' =>  $this->render('_summary'),                                
                                            
                                            
                                        ]);?>


                    <ul class="dor-pagination mb128">
                        <li class="page-link-prev"><a href="#"><img class="mr8"
                                                                    src="images/mini-left-arrow.svg" alt="arrow"> Назад</a>
                        </li>
                        <li><a href="#">1</a></li>
                        <li><a class="grey" href="#">...</a></li>
                        <li class="active"><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a class="grey" href="#">...</a></li>
                        <li><a href="#">10</a></li>
                        <li class="page-link-next"><a href="#">Далее <img class="ml8"
                                                                          src="images/mini-right-arrow.svg" alt="arrow"></a>
                        </li>
                    </ul>
                </div>
                
                <div class="col-lg-3 desctop-992-pl-16 d-flex flex-column vakancy-page-filter-block vakancy-page-filter-block-dnone">
                   <form id="searchform" action="<?=Url::current()?>">
                    <div
                            class="vakancy-page-filter-block__row mobile-flex-992 mb24 d-flex justify-content-between align-items-center">
                        <div class="heading">Фильтр</div>
                        <img class="cursor-p" src="images/big-cancel.svg" alt="cancel">
                    </div>
                    <div class="signin-modal__switch-btns-wrap resume-list__switch-btns-wrap mb16">
                        <a href="<?=Url::current(['sex' => null])?>" class="signin-modal__switch-btn <?=!isset($params['sex'])?'active':'' ?>">Все</a>
                        <a href="<?=Url::current(['sex' => '1'])?>" class="signin-modal__switch-btn <?=isset($params['sex']) && $params['sex'] == '1' ?'active':'' ?>">Мужчины</a>
                        <a href="<?=Url::current(['sex' => '2'])?>" class="signin-modal__switch-btn <?=isset($params['sex']) && $params['sex'] == '2' ?'active':'' ?>">Женщины</a>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Город</div>
                        <div class="citizenship-select">
                       <?//=$params['city']?> <? //var_dump($cities)?>
                        <?= Html::dropDownList('city', isset($params['city'])?$params['city']:'' , $cities,['class' => 'nselectlist-static formelement','id'=>'citylist', 'prompt' => '']) ?>
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Зарплата</div>
                        <div class="d-flex">
                        <?= Html::input('text', 'zp1',isset($params['zp1'])?$params['zp1']:'' , ['class' => 'dor-input w100 ','placeholder' => 'От','id'=>'zp1']) ?><img class="rub-icon" src="images/rub-icon.svg" alt="rub-icon">
                        <?= Html::input('text', 'zp2',isset($params['zp2'])?$params['zp2']:'' , ['class' => 'dor-input  w100','placeholder' => 'До','id'=>'zp2']) ?><img class="rub-icon" src="images/rub-icon.svg" alt="rub-icon">
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Специализация</div>
                        <div class="citizenship-select">
                        <?= Html::dropDownList('specialization_id',isset($params['specialization_id'])?$params['specialization_id']:'' , Specializations::find()->Select(['name','id'])->indexBy('id')->column(),['prompt'=>'Выберете специализацию..','id'=>'specialization','class' => 'nselectlist-static']) ?>
                    </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Возраст</div>
                        <div class="d-flex">
                        <?= Html::input('text', 'birthdate1',isset($params['birthdate1'])?$params['birthdate1']:'' , ['class' => 'dor-input w100 ','placeholder' => 'От','id'=>'birthdate1']) ?><img class="rub-icon" src="images/rub-icon.svg" alt="rub-icon">
                        <?= Html::input('text', 'birthdate2',isset($params['birthdate2'])?$params['birthdate2']:'' , ['class' => 'dor-input  w100','placeholder' => 'До','id'=>'birthdate2']) ?><img class="rub-icon" src="images/rub-icon.svg" alt="rub-icon">
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Опыт работы</div>
                        <div class="profile-info">
                            <div class="form-check d-flex">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1"></label>
                                <label for="exampleCheck1" class="profile-info__check-text">Без опыта</label>
                            </div>
                            <div class="form-check d-flex">
                                <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                <label class="form-check-label" for="exampleCheck2"></label>
                                <label for="exampleCheck2" class="profile-info__check-text">От 1 года до 3
                                    лет</label>
                            </div>
                            <div class="form-check d-flex">
                                <input type="checkbox" class="form-check-input" id="exampleCheck3">
                                <label class="form-check-label" for="exampleCheck3"></label>
                                <label for="exampleCheck3" class="profile-info__check-text">От 3 лет до 6
                                    лет</label>
                            </div>
                            <div class="form-check d-flex">
                                <input type="checkbox" class="form-check-input" id="exampleCheck4">
                                <label class="form-check-label" for="exampleCheck4"></label>
                                <label for="exampleCheck4" class="profile-info__check-text">Более 6 лет</label>
                            </div>
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Тип занятости</div>
                        <div class="profile-info">
                            <div class="form-check d-flex">
                                <input type="checkbox" class="form-check-input" id="exampleCheck5">
                                <label class="form-check-label" for="exampleCheck5"></label>
                                <label for="exampleCheck5" class="profile-info__check-text">Полная занятость</label>
                            </div>
                            <div class="form-check d-flex">
                                <input type="checkbox" class="form-check-input" id="exampleCheck6">
                                <label class="form-check-label" for="exampleCheck6"></label>
                                <label for="exampleCheck6" class="profile-info__check-text">Частичная
                                    занятость</label>
                            </div>
                            <div class="form-check d-flex">
                                <input type="checkbox" class="form-check-input" id="exampleCheck7">
                                <label class="form-check-label" for="exampleCheck7"></label>
                                <label for="exampleCheck7" class="profile-info__check-text">Проектная работа</label>
                            </div>
                            <div class="form-check d-flex">
                                <input type="checkbox" class="form-check-input" id="exampleCheck8">
                                <label class="form-check-label" for="exampleCheck8"></label>
                                <label for="exampleCheck8" class="profile-info__check-text">Стажировка</label>
                            </div>
                            <div class="form-check d-flex">
                                <input type="checkbox" class="form-check-input" id="exampleCheck9">
                                <label class="form-check-label" for="exampleCheck9"></label>
                                <label for="exampleCheck9" class="profile-info__check-text">Волонтёрство</label>
                            </div>
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">График работы</div>
                        <div class="profile-info">
                            <div class="form-check d-flex">
                                <input type="checkbox" class="form-check-input" id="exampleCheck10">
                                <label class="form-check-label" for="exampleCheck10"></label>
                                <label for="exampleCheck10" class="profile-info__check-text">Полный день</label>
                            </div>
                            <div class="form-check d-flex">
                                <input type="checkbox" class="form-check-input" id="exampleCheck11">
                                <label class="form-check-label" for="exampleCheck11"></label>
                                <label for="exampleCheck11" class="profile-info__check-text">Сменный график</label>
                            </div>
                            <div class="form-check d-flex">
                                <input type="checkbox" class="form-check-input" id="exampleCheck12">
                                <label class="form-check-label" for="exampleCheck12"></label>
                                <label for="exampleCheck12" class="profile-info__check-text">Вахтовый метод</label>
                            </div>
                            <div class="form-check d-flex">
                                <input type="checkbox" class="form-check-input" id="exampleCheck13">
                                <label class="form-check-label" for="exampleCheck13"></label>
                                <label for="exampleCheck13" class="profile-info__check-text">Гибкий график</label>
                            </div>
                            <div class="form-check d-flex">
                                <input type="checkbox" class="form-check-input" id="exampleCheck14">
                                <label class="form-check-label" for="exampleCheck14"></label>
                                <label for="exampleCheck14" class="profile-info__check-text">Удалённая
                                    работа</label>
                            </div>
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row vakancy-page-filter-block__show-vakancy-btns mb24 d-flex flex-wrap align-items-center mobile-jus-cont-center">
                        <button type="submit" class="link-orange-btn orange-btn mr24 mobile-mb12" href="#">Показать <span>1 230</span>
                            вакансии</button>
                        <a href="#">Сбросить все</a>
                    </div>
                                        </form>
                </div>
            </div>
        </div>
    </div>
    <?php Pjax::end(); ?>
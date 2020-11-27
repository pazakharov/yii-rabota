<?php 
use yii\helpers\Url;
use yii\widgets\ListView;
?>

<div class="content">
<div class="container">
    <div class="col-lg-9">
        <div class="main-title mb32 mt50 d-flex justify-content-between align-items-center">Мои резюме
            <a href="<?=Url::toRoute('resume/create') ?>" class="link-orange-btn orange-btn my-vacancies-add-btn">Добавить резюме</a><a
                class="my-vacancies-mobile-add-btn link-orange-btn orange-btn plus-btn" href="<?=Url::toRoute('resume/create') ?>">+</a></div>
        <div class="tabs mb64">
            <div class="tabs__content active">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex">
                            <!-- <div class="paragraph mb8 mr16">У вас <span>5</span> резюме</div> -->
                        </div>

                        <?= ListView::widget([
                                            'dataProvider' => $dataProvider,
                                            'itemView' => '_short_resume_my',
                                            'itemOptions' => ['tag' => false],
                                        
                                            
                

                            ]); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
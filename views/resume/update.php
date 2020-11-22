<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Resume */

$this->title = Yii::t('app', 'Редактирование резюме ID:{name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Resumes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="content p-rel">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="mt8 mb40"><a href="<?php echo Url::to(['resume/index'])?>#"><img src="images/blue-left-arrow.svg" alt="arrow"> Вернуться без
                        сохранения</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title mb24"><?= Html::encode($this->title) ?></div>
            </div>
        </div>
        <?= $this->render('_form', [
        'model' => $model,
        'model2' => $model2,
        
    ]) ?>

    </div>
</div>

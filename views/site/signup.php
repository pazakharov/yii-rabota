<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\SignUpAsset;

SignUpAsset::register($this);

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrap">
    <div class="container">
        <div class="site-signup">
            <h1 class="main-title mt24 mb16"><?= Html::encode($this->title) ?></h1>

            <div class="paragraph-lead mb16"> <span> Заполните поля для регистрации:</span> </div>

            <div class="row">
                <div class="col-lg-5">
                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <div class="input-wrap">
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                    </div>

                    <div class="input-wrap">
                        <?= $form->field($model, 'email') ?>
                    </div>

                    <div class="input-wrap">
                        <?= $form->field($model, 'password')->passwordInput() ?>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
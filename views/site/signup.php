<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="o-page__card">
    <div class="c-card u-mb-xsmall">

        <header class="c-card__header u-pt-medium">
            <h1 class="u-h3 u-text-center u-mb-zero"><?= Html::encode($this->title) ?></h1>
        </header>



            <?php $form = ActiveForm::begin(['id' => 'form-signup',
                'options' => ['class'=>'c-card__body'],
                'fieldConfig' => [
                    'options'=> ['class' =>'c-field u-mb-small'],
                ],

                ]); ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'c-btn c-btn--info c-btn--fullwidth', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>


    </div>
</div>
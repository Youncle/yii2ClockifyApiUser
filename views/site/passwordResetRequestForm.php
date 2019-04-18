<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="o-page__card">
    <div class="c-card u-mb-xsmall">

        <header class="c-card__header u-text-center u-pt-large">

            <div class="row u-justify-center">
                <div class="col-9">
                    <h1 class="u-h3">Forgot your password</h1>
                    <p class="u-h6 u-text-mute">
                        Enter your email address to receive password reset instructions
                    </p>
                </div>
            </div>
        </header>



        <?php $form = ActiveForm::begin([
            'options' => ['class'=>'c-card__body'],
            'fieldConfig' => [
                'options'=> ['class' =>'c-field u-mb-small'],
            ],
        ]); ?>
                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                    <?= Html::submitButton('Send Password Reset Instructions', ['class' => 'c-btn c-btn--info c-btn--fullwidth']) ?>

                <?php ActiveForm::end(); ?>

    </div>
</div>
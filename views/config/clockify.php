<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<main class="o-page__content">
 <div class="container">
    <div class="row u-mb-large">
        <div class="col-12">
            <div class="c-tabs__content tab-content" id="nav-tabContent">
                <div class="row">



        <?php $form = ActiveForm::begin([
            'options' => ['class'=>'col-lg-5'],
            'fieldConfig' => [
                'options'=> ['class' =>'c-field u-mb-small'],
            ],
        ]); ?>

        <?= $form->field($model, 'workspaceId')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'apiKey')->textInput(['maxlength' => true]) ?>


            <?= Html::submitButton('Submit', ['class' => 'c-btn c-btn--info c-btn--fullwidth']) ?>


        <?php ActiveForm::end(); ?>

                </div>
            </div>

        </div>
    </div>
 </div>
</main>
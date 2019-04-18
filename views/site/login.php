<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="o-page__card">
    <div class="c-card u-mb-xsmall">

        <header class="c-card__header u-pt-medium">
                    <h1 class="u-h3 u-text-center u-mb-zero"><?= Html::encode($this->title) ?></h1>
        </header>


    <?php $form = ActiveForm::begin([
        'options' => ['class'=>'c-card__body'],
        'fieldConfig' => [
                'options'=> ['class' =>'c-field u-mb-small'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>



            <?= Html::submitButton('Login', ['class' => 'c-btn c-btn--info c-btn--fullwidth', 'name' => 'login-button']) ?>

        <span class="c-divider c-divider--small has-text u-mv-medium"></span>


        <?php ActiveForm::end(); ?>

        <div class="o-line">
            <a class="u-text-mute u-text-small" href="<?= Url::to(['/site/signup'])?>">Don’t have an account yet?</a>
            <a class="u-text-mute u-text-small" href="<?= Url::to(['site/request-password-reset'])?>">Forgot password?</a>
        </div>

    </div>

</div>


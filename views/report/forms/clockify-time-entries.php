<?php
/**
 * Created by PhpStorm.
 * User: valcher
 * Date: 25.03.2019
 * Time: 14:14
 */



use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\form\ClockifyTimeEntriesReportForm;

/* @var $this yii\web\View */
/* @var $model app\models\Config */
/* @var $form yii\widgets\ActiveForm */

$model = new ClockifyTimeEntriesReportForm();

?>

<main class="o-page__content">
    <div class="container">
        <main class="row u-mb-large">
            <div class="col-12">
                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="row">

        <?php $form = ActiveForm::begin([
                'action' =>['report/generate', 'reportId'=> \app\components\ClockifyClient::REPORT_TIME_ENTRIES],
            'options' => ['class'=>'col-lg-5'],
            'fieldConfig' => [
                'options'=> ['class' =>'c-field u-mb-small'],
            ],
        ]); ?>

        <?= $form->field($model, 'timeStart')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'timeEnd')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'userEmail')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'projectId')->textInput(['maxlength' => true]) ?>



            <?= Html::submitButton('Get Report', ['class' => 'c-btn c-btn--info c-btn--fullwidth']) ?>


        <?php ActiveForm::end(); ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</main>



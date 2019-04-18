<?php
use app\models\form\ClockifyTimeEntriesReportForm;

$className = Yii::$app->controller->formModel[$reportId];
?>

<div class="row">
    <div class="col-sm-12">
        <div class="u-mv-large u-text-center">
            <h2>Input Info</h2>

<?= Yii::$app->controller->renderPartial('forms/' . Yii::$app->controller->formView[$reportId],
    ['model' => new $className])?>
        </div>
    </div>
</div>

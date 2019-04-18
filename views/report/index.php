<?php

use yii\helpers\Html;
use app\components\AGridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $reports yii\data\ActiveDataProvider */
/* @var $reportIdList array */

$this->title = 'Reports';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container u-mb-large">

    <div class="row">

        <div class="col-sm-12">


    <?php $form = ActiveForm::begin(
            [
                    'action' => ['build'],
                    'method'=>'get',
            ]);
    ?>

    <h1><?= Html::encode($this->title) ?></h1>

            <div class="col-md-6">
            <div class="c-field u-mb-medium">
                <label class="c-field__label" for="select1">Select Api</label>
        <select class="c-select" id="select1" name="reportId">
            <option selected="selected">Choose one</option>
            <?php

            foreach($reportIdList as $value=>$item){
                ?>
                <option value="<?php echo $value; ?>"><?php echo $item; ?></option>
                <?php
            }
            ?>
        </select>
            </div>
            </div>


       <?= Html::submitButton('Go', ['class' => 'c-btn c-btn--info']) ?>

    <?php ActiveForm::end(); ?>

        <div class="c-table-responsive@desktop">
    <?= AGridView::widget([
        'dataProvider' => $reports,
        'layout' => '{items} {pager}',
        'tableOptions' => ['class' =>'c-table'],
        'theadOptions' => [
            'class' => 'c-table__head c-table__head--slim'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'filename',
            'size',
            'type',

            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{download} {delete}',
                'buttons' => [
                        'download' => function ($url, $model) {
                        return Html::a('<i class="glyphicon glyphicon-download"></i>', $url, [
                            'title' => Yii::t('app', 'download'),
                        ]);
                    },

                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('app', 'delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method'  => 'post',
                        ]);
                    }

                ],
            ],
        ],


    ]); ?>
        </div>
        </div>
</div>

</div>

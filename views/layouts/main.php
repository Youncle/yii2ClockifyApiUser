<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\ThemeAsset;
use app\widgets\Alert;

ThemeAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body class="o-page">
    <?php $this->beginBody() ?>


    <?= Alert::widget() ?>

    <?= $this->render('sidebar') ?>


    <main class="o-page__content">

    <?= $this->render('header') ?>

    <?= $content ?>


    <?php $this->endBody() ?>

        </body>
    </html>
<?php $this->endPage() ?>










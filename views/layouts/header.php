<?php

use yii\helpers\Url;
use yii\helpers\Html;

?>

<header class="c-navbar">

    <nav class="c-nav collapse" id="main-nav">
        <ul class="c-nav__list">

            <li class="c-nav__item">
               <?= Html::a('Log Out', ['site/logout'], ['data' => ['method' => 'post']]) ?>
            </li>
        </ul>
    </nav>

</header>
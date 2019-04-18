<?php

use yii\helpers\Url;

?>
<div class="o-page__sidebar js-page-sidebar">
    <div class="c-sidebar">


        <h4 class="c-sidebar__title">Dashboards</h4>
        <ul class="c-sidebar__list">

            <li class="c-sidebar__item">
                <a class="c-sidebar__link" href="<?= Url::to(['/site/index'])?>">
                    <i class="fa fa-home u-mr-xsmall"></i>Home
                </a>
            </li>


        </ul>

        <h4 class="c-sidebar__title">Apps</h4>
        <ul class="c-sidebar__list">
            <li class="c-sidebar__item has-submenu">
                <a class="c-sidebar__link" data-toggle="collapse" href="#sidebar-submenu" aria-expanded="false" aria-controls="sidebar-submenu">
                    <i class="fa fa-caret-square-o-down u-mr-xsmall"></i>Clockify API
                </a>
                <ul class="c-sidebar__submenu collapse" id="sidebar-submenu">
                    <li><a class="c-sidebar__link" href="<?= Url::to(['/report/index'])?>">Reports</a></li>
                    <li><a class="c-sidebar__link" href="<?= Url::to(['/config/clockify'])?>">Setup Keys</a></li>
                </ul>
            </li>

        </ul>


    </div><!-- // .c-sidebar -->
</div><!-- // .o-page__sidebar -->


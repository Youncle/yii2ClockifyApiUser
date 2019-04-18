<?php

use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'API Connect';
?>


<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="u-mv-large u-text-center">
                <h2 class="u-mb-xsmall">Welcome back to ApiConnect</h2>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-lg-4">
            <div class="c-card u-p-medium u-text-center u-mb-medium" data-mh="landing-cards">

                <img class="u-mb-small" src="img/icon-intro1.svg" alt="iPhone icon">

                <h4 class="u-h6 u-text-bold u-mb-small">
                    Check your performance. See the results of all your active campaings.
                </h4>
                <a class="c-btn c-btn--info" href="#">Start new Campaign</a>
            </div>
        </div>

        <div class="col-sm-12 col-lg-4">
            <div class="c-card u-p-medium u-text-center u-mb-medium" data-mh="landing-cards">

                <img class="u-mb-small" src="img/icon-intro2.svg" alt="iPhone icon">

                <h4 class="u-h6 u-text-bold u-mb-small">
                    Start console and prepare new stuff for your customers or community!
                </h4>
                <a class="c-btn c-btn--info" href="#">View your reports</a>
            </div>
        </div>

        <div class="col-sm-12 col-lg-4">
            <div class="c-card u-p-medium u-text-center u-mb-medium" data-mh="landing-cards">

                <img class="u-mb-small" src="img/icon-intro3.svg" alt="iPhone icon">

                <h4 class="u-h6 u-text-bold u-mb-small">
                    All Files ready? <br>Start promoting your apps today.
                </h4>
                <a class="c-btn c-btn--info" href="#">Start using Dashboar</a>
            </div>
        </div>
    </div>

    <div class="row u-mt-small">
        <div class="col-lg-6">
            <h3 class="u-mb-small">Dashboard Overview</h3>

            <div class="c-card c-overview-card u-p-medium u-mb-medium">
                <div class="row">
                    <div class="col-4 u-border-right">
                        <div class="c-overview-card__section">
                            <h3 class="u-mb-zero">801, 523</h3>
                            <p class="u-text-mute u-mb-small">Newsletters Sent</p>
                            <canvas id="js-chart-newsletters" width="300" height="250"></canvas>
                        </div>
                    </div>

                    <div class="col-4 u-border-right">
                        <div class="c-overview-card__section">
                            <h3 class="u-mb-zero">801, 523</h3>
                            <p class="u-text-mute u-mb-small">Newsletters Sent</p>
                            <canvas id="js-chart-subscribers" width="300" height="250"></canvas>
                        </div>

                    </div>

                    <div class="col-4">
                        <div class="c-overview-card__section">
                            <h3 class="u-mb-zero">801, 523</h3>
                            <p class="u-text-mute u-mb-small">Newsletters Sent</p>
                            <canvas id="js-chart-conversion" width="300" height="250"></canvas>
                        </div>
                    </div>
                </div>

                <span class="c-divider u-mv-medium u-opacity-medium"></span>

                <div class="row">
                    <div class="col-6 col-md-3 u-border-right">
                        <div class="c-overview-card__section">
                            <p class="u-text-mute u-nospace">Open Rate</p>
                            <h3 class="u-nospace">32.21%</h3>

                            <div class="c-progress c-progress--info c-progress--small u-mb-zero">
                                <div class="c-progress__bar" style="width:15%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 u-border-right">
                        <div class="c-overview-card__section">
                            <p class="u-text-mute u-nospace">Read Rate</p>
                            <h3 class="u-nospace">75.21%</h3>

                            <div class="c-progress c-progress--info c-progress--small u-mb-zero">
                                <div class="c-progress__bar" style="width:75.21%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="c-overview-card__section">
                            <p class="u-text-mute u-nospace">Attachments</p>
                            <h3 class="u-nospace">63.45%</h3>

                            <div class="c-progress c-progress--info c-progress--small u-mb-zero">
                                <div class="c-progress__bar" style="width:63.45%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 u-border-left">
                        <div class="c-overview-card__section">
                            <p class="u-text-mute u-nospace">New Subs</p>
                            <h3 class="u-nospace">72.4%</h3>

                            <div class="c-progress c-progress--success c-progress--small u-mb-zero">
                                <div class="c-progress__bar" style="width:72.4%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
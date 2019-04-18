<?php

namespace app\mail;

use yii\helpers\Html;
use Yii;


$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->passwordResetToken]);
?>

<div class="password-reset">
    <p>Hello <?= Html::encode($user->username) ?>,</p>
    <p>Follow the link below to reset your password:</p>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
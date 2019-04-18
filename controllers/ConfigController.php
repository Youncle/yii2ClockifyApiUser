<?php

namespace app\controllers;


use app\models\ClockifyConfigForm;
use Yii;
use yii\web\Controller;

class ConfigController extends Controller
{


    /**
     * @return string|\yii\web\Response
     *
     */

    public function actionClockify()
    {
        $model = new ClockifyConfigForm;
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->getSession()->setFlash('success', 'successfully updated');
           return $this->redirect('../report/index');
        }
        return $this->render('clockify', [
            'model' => $model,
        ]);
    }

}
<?php

namespace app\controllers;

use app\components\ClockifyClient;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\form\ClockifyTimeEntriesReportForm;
use Yii;
use app\models\Document;

class ReportController extends Controller
{
    public $reportIdList = [
        ClockifyClient::REPORT_TIME_ENTRIES => 'Clockify - Time Entries',

    ];

    /**
     * @var array
     */
    public $formModel = [
        ClockifyClient::REPORT_TIME_ENTRIES => ClockifyTimeEntriesReportForm::class,
    ];

    /**
     * @var array
     */
    public $formView = [
        ClockifyClient::REPORT_TIME_ENTRIES => ClockifyTimeEntriesReportForm::FORM_VIEW,
    ];


    /**
     * @return string
     */
    public function actionIndex()
    {
        $reports=new ActiveDataProvider([
            'query' => Document::find()->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('index',[
            'reports' => $reports,
            'reportIdList' => $this->reportIdList
        ]);
    }

    /**
     * @param $reportId
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionBuild($reportId)
    {
        if (isset($this->formModel[$reportId])) {
            return $this->render('form', ['reportId'=>$reportId]);
        }

        throw new NotFoundHttpException('Unknown report!');
    }

    /**
     * @param $reportId
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionGenerate($reportId)
    {
        if (isset($this->formModel[$reportId])) {

            $model = new ClockifyTimeEntriesReportForm;

            if ($reportId == ClockifyClient::REPORT_TIME_ENTRIES) {

                if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                    $model->reportId = $reportId;
                    $location = $model->generate();
                    if (!empty($location)) {

                        Yii::$app->getSession()->setFlash('success', 'report file successfully generated');
                        return $this->redirect(['report/index']);
                    } else {
                        throw new NotFoundHttpException('Report not found!');
                    }
                }
//                print_r($model->getErrors());die;
            }
        }

        throw new NotFoundHttpException();
    }


    /**
     * @param $id
     * @return \yii\console\Response|\yii\web\Response
     */
    public function actionDownload($id)
    {
        $download = Document::findOne($id);
        $path='/home/youncle/workspace/clockify/reports' . '/' . $download->filename;
        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        } else {
            throw new NotFoundHttpException("can't find {$download->filename} file");
        }
    }


    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Document model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Document the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Document::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
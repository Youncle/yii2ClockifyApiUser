<?php

namespace app\models\form;

use Yii;
use yii\base\Model;
use app\models\Document;


class ClockifyTimeEntriesReportForm extends Model
{
    const FORM_VIEW = 'clockify-time-entries';

    public $timeStart;
    public $timeEnd;
    public $userEmail;
    public $projectId;
    public $reportId;
    public $storagePath = '/home/youncle/workspace/clockify/reports';


    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['timeStart','timeEnd'], 'required'],
//            [['timeStart','timeEnd'], safe],

            [['projectId'], 'string'],
            ['userEmail','email']

        ];
    }


    /**
     * @return Document|null
     */
    public function generate()
    {

        $document='doc_report_clockify_'. $this->reportId . time() . '.csv';
        $fullPath = $this->storagePath . '/' . $document;

        $client = Yii::$app->clockifyClient;
        $data = $client->getReport($this->timeStart, $this->timeEnd, $this->userEmail, $this->projectId);
        if (empty($data)) {
            $data = array();
        }

         $this->saveToDisk($data,$fullPath);

        return $this->saveToDb($document,$fullPath);
    }


    /**
     * @param $data
     * @param $fullPath
     */
    public function saveToDisk($data,$fullPath)
    {

        $fp = fopen( $fullPath, 'w');
        fputcsv($fp, ['id','name','email','task','description','project','totalTime', 'Time(decimal)','projectTotalTime']);

        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);
    }

    /**
     * @param $document
     * @param $fullPath
     * @return Document|null
     */
    public function saveToDb($document,$fullPath)
    {

        $model = new Document();
        $model->filename=$document;
        $model->size = filesize($fullPath);
        $model->extension = '.csv';
        $model->type = $this->reportId;


        if (!$model->save()) {
            return null;
        }

        return $model;
    }

}

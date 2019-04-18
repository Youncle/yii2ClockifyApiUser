<?php

namespace app\components;

use Yii;
use yii\base\Component;
use app\models\Config;
use yii\base\Exception;
use http\Exception\InvalidArgumentException;
use DateTime;
use DateInterval;
use yii\helpers\VarDumper;


class ClockifyClient extends Component
{
    const REPORT_TIME_ENTRIES = 'clockifyTimeEntries';

    const API_URL = "https://api.clockify.me/api/";

    public $apiKey;
    public $workspaceId;

    public function init()
    {
        parent::init();
        $this->loadConfig();
    }

    /**
     * @return bool
     * @throws Exception
     */

    public function loadConfig()
    {
        $configs = Config::find()->where(['owner'=>Config::OWNER_CLOCKIFY, 'userId'=>Yii::$app->user->id])->all();

        if (empty($configs) || (count($configs) != 2)) {
            throw new \yii\base\Exception('clockify connection keys not found');
        }
        $i = 0;

        foreach ($configs as $item) {
            if ($item->key == 'workspaceId') {
                $this->workspaceId = $item->value;
                $i++;
            }
            if ($item->key == 'apiKey') {
                $this->apiKey = $item->value;
                $i++;
            }

        }
        if ($i == 2) return true;

        throw new Exception('Critical config missing! Go away!');
    }


    /**
     * @param $timeStart
     * @param $timeEnd
     * @param null $userEmail
     * @param null $projectId
     * @return \Exception|InvalidArgumentException
     * @throws \yii\base\InvalidConfigException
     */
    public function getReport($timeStart,$timeEnd, $userEmail=null, $projectId=null)
    {
        $finalData=[];
        $projectArray=[];

        try {
            $rawData = $this->prepareRequestData($timeStart, $timeEnd, $userEmail, $projectId);
            $data = json_encode($rawData);

            $timeEntriesRaw = $this->apiRequest('workspaces/' . $this->workspaceId . '/reports/summary/', $data);
            $timeEntries = json_decode($timeEntriesRaw, true);

            if (is_array($timeEntries)) {


                    foreach ($timeEntries['projectAndTotalTime'] as $item) {

                        $projectArray[$item['projectName']] = $item['duration'];

                    }


                foreach ($timeEntries['timeEntries'] as $item) {

                    $hmsTime = $this->changeTimeFormat($item['timeInterval']['duration']);
                    $found = preg_match('/#(\d+)/', $item['description'], $match);
                    $localTrackedSeconds = $this->timeToSeconds($hmsTime);
                    if ($found) {
                        $key =trim($match['0']);

                        if (!isset($finalData[$key])) {
                            $finalData[$key] = [
                                'id' => $item['user']['id'],
                                'name' => $item['user']['name'],
                                'email' => $item['user']['email'],
                                'taskId' => $key,
                                'description' => $item['description'],
                                'projectName' => $item['project']['name'],
                                'trackedSeconds' => $localTrackedSeconds,
                                'time' => $this->secToHR($localTrackedSeconds),
                                'billingTime' =>  round($localTrackedSeconds/3600, 2),
                                'projectTotalTime' => $this->changeTimeFormat($projectArray[$item['project']['name']])

                            ];
                        } else {
                            $totalTrackedSeconds = ($finalData[$key]['trackedSeconds'] + $localTrackedSeconds);

                            $finalData[$key] = [
                                'id' => $item['user']['id'],
                                'name' => $item['user']['name'],
                                'email' => $item['user']['email'],
                                'taskId' => $key,
                                'description' => $item['description'],
                                'projectName' => $item['project']['name'],
                                'trackedSeconds' => $totalTrackedSeconds,
                                'time' =>$this->secToHR($totalTrackedSeconds),
                                'billingTime' =>  round($totalTrackedSeconds/3600, 2),
                                'projectTotalTime' => $this->changeTimeFormat($projectArray[$item['project']['name']])
                            ];

                        }
                    } else {
                        $finalData[] = [
                            'id' => $item['user']['id'],
                            'name' => $item['user']['name'],
                            'email' => $item['user']['email'],
                            'taskId' => $item['description'],
                            'rawDescription' => $item['description'],
                            'projectName' => 'none',
                            'trackedSeconds' => $localTrackedSeconds,
                            'time' => $hmsTime,
                            'billingTime' =>  round($this->timeToSeconds($hmsTime)/3600,2),
                            'projectTotalTime' => 'none'
                        ];
                    }
                }
            }

            $finalData = array_map(function ($item) {
                unset($item['trackedSeconds']);
                return $item;
            }, $finalData);

            return $finalData;

        } catch( InvalidArgumentException $e ) {

            return $e;
        }

    }


    /**
     * @param $url
     * @param $headers
     * @param $postData
     * @param bool $headerFunction
     * @return false|resource
     */
    protected function getCurl( $url, $headers, $postData, $headerFunction = false)
    {
        $curlHandler=curl_init();
        curl_setopt( $curlHandler, CURLOPT_URL, $url);

        if ($headers) {
            curl_setopt( $curlHandler, CURLOPT_HTTPHEADER, $headers);
        }

        if ($headerFunction) {
            curl_setopt( $curlHandler, CURLOPT_HEADERFUNCTION, $headerFunction);
        }

        curl_setopt( $curlHandler, CURLOPT_FAILONERROR, true);
        curl_setopt( $curlHandler, CURLOPT_RETURNTRANSFER, true);

        if ($postData) {
            curl_setopt( $curlHandler, CURLOPT_POSTFIELDS, $postData);
        } else {
            curl_setopt($curlHandler,CURLOPT_HTTPGET,1);
        }
        return $curlHandler;
    }


    /**
     * @param $apiPath
     * @param bool $postData
     * @return bool|string
     */
    protected function apiRequest($apiPath, $postData= false)
    {

        $requestHeaders = array(
            'Content-Type:application/json',
            'X-Api-Key:' . $this->apiKey
        );

        if ( $postData ) {
            $requestHeaders[] = 'Content-Length:' . strlen( $postData );
        }
        $ch = $this->getCurl(
            self::API_URL . $apiPath,
            $requestHeaders,
            isset( $postData ) ? $postData : false
        );
        $result = curl_exec( $ch );
        if ( curl_error( $ch ) ) {
            return curl_error( $ch );
        } else {
            return $result;
        }
    }


    /**
     * @param $time
     * @return float|int
     */
    protected function timeToSeconds($time) // converting H:I:S to seconds
    {
        $time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $time);

        sscanf($time, "%d:%d:%d", $hours, $minutes, $seconds);

        $timeSeconds = $hours * 3600 + $minutes * 60 + $seconds;

        return $timeSeconds;
    }


    /**
     * @param $seconds
     * @return string
     */
    function secToHR($seconds) {  // converting seconds to H:I:S
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds / 60) % 60);
        $seconds = $seconds % 60;
        return sprintf("%02d%s%02d%s%02d", $hours, ':' , $minutes, ':', $seconds);


    }


    /**
     * @param $dateInterval
     * @return array|string
     */
    protected function cleanDateInterval($dateInterval)
    {
        // because PHP is broken: https://bugs.php.net/bug.php?id=53831
        $fixed = explode( ".", $dateInterval );
        if (isset($fixed[1])) {
            $fixed = $fixed[0] . substr($fixed[1], -1);
        } else {
            $fixed = $fixed[0];
        }
        return $fixed;
    }


    /**
     * @param $time
     * @return array|string
     * @throws \Exception
     */
    protected function changeTimeFormat($time)
    {
        $time = $this->cleanDateInterval($time);
        $obj = new DateInterval($time);

        if (!($obj instanceof DateInterval))
            throw new InvalidArgumentException('object is not an instance of DateTime');

        $time = $obj->format('%H:%I:%S');

        return $time;
    }

    /**
     * @param $string
     * @return bool
     */
    protected function isJson($string)
    {
        return true;
    }


    /**
     * @return mixed
     */
    protected function getUsers()
    {
        $response = $this->apiRequest('workspaces/' . $this->workspaceId. '/users');
        $clockifyUsers = json_decode($response, true);

        return $clockifyUsers;
    }

    /**
     * @return mixed
     */
    protected function getProjects()
    {
        $response = $this->apiRequest('workspaces/'. $this->workspaceId .'/projects/');
        $clockifyProjects = json_decode($response, true);

        return $clockifyProjects;
    }


    /**
     * @param $start
     * @param $end
     * @param null $userEmail
     * @param null $project
     * @return array
     */
    protected function prepareRequestData($start, $end, $userEmail = null, $project = null)
    {
        $obj=DateTime::createFromFormat('d.m.Y', trim($start));

        if (!($obj instanceof DateTime))
            throw new InvalidArgumentException('object is not an instance of DateTime');

        $start=$obj->format('Y-m-d');

        $obj=DateTime::createFromFormat('d.m.Y', trim($end));

        if (!($obj instanceof DateTime))
            throw new InvalidArgumentException('object is not an instance of DateTime');

        $end = $obj->format('Y-m-d');

        $users = $this->getUsers();
        $userIds = [];
        if (!empty($userEmail)) {
            $userIds = array_map(function ($item) {return $item['id'];}, array_filter($users, function ($user) use ($userEmail) {return $user['email'] == $userEmail;}));
        }

        $projects = $this->getProjects();
        $projectIds = [];
        if (!empty($project)) {
            $projectIds = array_map(function ($item) {
                return $item['id'];
            }, array_filter($projects, function ($item) use ($project) {
                return $item['id'] == $project;
            }));
        }

        return [
            "startDate" => $start . "T00:00:00.000Z",
            "endDate" => $end . "T23:59:59.999Z",
            "me"=> "false",
            "userGroupIds"=> [],
            "userIds"=> array_values($userIds),
            "projectIds"=> array_values($projectIds),
            "clientIds"=> [],
            "taskIds"=> [],
            "tagIds"=> [],
            "billable"=> "BOTH",
            "includeTimeEntries"=> "true",
            "zoomLevel"=> "week",
            "description"=> "",
            "archived"=> "Active",
            "roundingOn"=> "false"
        ];
    }

}
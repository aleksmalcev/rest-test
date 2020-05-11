<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 30.04.2020
 * Time: 17:16
 */

namespace RestTest\Controller;


abstract class BaseController
{
    /**
     * Action execution
     *
     * @param $method
     * @param $actionName
     * @param $actionValue
     */
    public function execAction($method, $actionName, $actionValue)
    {
        $action = 'action'.$method.'_'.$actionName;
        if (method_exists($this, $action)) {
            if (isset($actionValue)) {
                $this->$action($actionValue);
            } else {
                $this->$action();
            }
        } else {
            $statusCode = 500;
            $statusTxt = 'Method not found - '.$action;
            $this->replyBaseHeader($statusCode, $statusTxt);
        }
    }

    public function getHttpStatusTxt($statusCode)
    {
        $stArr = array(
            200 => 'OK',
            404 => 'Not Found',
            500 => 'Internal Server Error'
        );
        return ($stArr[$statusCode])?$stArr[$statusCode]:$stArr[500];
    }

    protected function replyBaseHeader($statusCode, $statusTxt = '')
    {
        if (empty($statusTxt)) {
            $statusTxt = $this->getHttpStatusTxt($statusCode);
        }
        header("HTTP/1.1 $statusCode $statusTxt");
    }
}
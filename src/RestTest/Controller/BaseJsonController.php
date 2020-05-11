<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 09.05.2020
 * Time: 14:54
 */

namespace RestTest\Controller;


class BaseJsonController extends BaseController
{
    protected function replyBaseHeader($statusCode, $statusTxt = '')
    {
        parent::replyBaseHeader($statusCode, $statusTxt);
        header("Content-Type: application/json;charset=utf-8");
    }

    public function replyJson($data, $statusCode=200)
    {
        $this->replyBaseHeader($statusCode);
        $jsonData = json_encode($data);
        echo $jsonData;
    }

    public function replyJsonErr($errStr)
    {
        $err = ['error' => $errStr];
        $this->replyJson($err, 404);
    }
}
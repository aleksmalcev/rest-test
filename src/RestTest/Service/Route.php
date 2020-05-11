<?php

namespace RestTest\Service;

use RestTest\Controller\AuthController;
use RestTest\Controller\ErrorController;


class Route
{
    /**
     * Return array with controllerName and actionName
     *  ['controllerName'=>, 'actionName'=>]
     *
     * @param $uri
     * @return array
     */
    static function processUri($uri)
    {
        $uri = urldecode($uri);
        $ipos = strpos($uri, '?');
        if ($ipos !== false) {
            $uri = substr($uri, 0, $ipos);
        }

        $res = [];
        $uriParts = explode('/', $uri);
        if (count($uriParts) < 2) {
            return $res;
        }

        // store controller name and action
        $res['controllerName'] = strtolower($uriParts[1]);
        if (count($uriParts) > 2) {
            $res['actionName'] = strtolower($uriParts[2]);
        } else {
            $res['actionName'] = null;
        }

        // remove word separator "_" and make camel notation word
        foreach ($res as $key => $val) {
            $words = explode('_', $val);
            foreach ($words as $key1 => $val2) {
                $words[$key1] = ucfirst($val2);
            }
            $res[$key] = implode('',$words);
        }

        // store action value
        if (count($uriParts) > 3) {
            $res['actionValue'] = $uriParts[3];
        } else {
            $res['actionValue'] = null;
        }

        return $res;
    }

    static function run()
    {
        $ctrlData = self::processUri($_SERVER['REQUEST_URI']);

        $errorController = new ErrorController();
        if (empty($ctrlData)) {
            $errorController->actionError404();
        }

        $controllerName = $ctrlData['controllerName'];
        $actionName = '';
        if (empty($controllerName)) {
            $controllerName = CtrlMng::mainPageControllerName();
            $actionName = CtrlMng::mainPageControllerActionName();
        }

        $controller = CtrlMng::getController($controllerName);
        if (! isset($controller)) {
            $errorController->actionError404();
        }

        if (empty($actionName)) {
            $actionName = $ctrlData['actionName'];
        }

        $actionValue = $ctrlData['actionValue'];
        $method = $_SERVER['REQUEST_METHOD'];
        $controller->execAction($method, $actionName, $actionValue);
    }

    static private function prepareNamesForUrl($name)
    {
        $res = [];
        preg_match_all('/[A-Z][^A-Z]+/',$name,$res,PREG_PATTERN_ORDER);
        $name = implode('_', $res[0]);
        $name = strtolower($name);
        return $name;
    }

    static function getUrl($controllerName, $actionName)
    {
        $errPart = 'should used latin letters, words without space, each word start uppercase letter';
        $controllerNameForUrl = self::prepareNamesForUrl($controllerName);
        if (empty($controllerNameForUrl)) {
            $err = 'Error controller name:'.$controllerName.' Controller name '.$errPart;
            throw new \Exception($err);
        }

        $actionNameForUrl = self::prepareNamesForUrl($actionName);
        if (empty($actionNameForUrl)) {
            $err = 'Error action name:'.$controllerName.' Action name '.$errPart;
            throw new \Exception($err);
        }
        return '/'.$controllerNameForUrl.'/'.$actionNameForUrl;
    }

    static function getDefaultUrl()
    {
        $controllerName = CtrlMng::defaultControllerName();
        $actionName = CtrlMng::defaultControllerActionName();
        return self::getUrl($controllerName, $actionName);
    }
}

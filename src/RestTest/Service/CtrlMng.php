<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 02.05.2020
 * Time: 15:15
 */

namespace RestTest\Service;


use RestTest\App;
use RestTest\Controller\BaseController;


/**
 * Controller Manager
 *
 * Class CtrlMng
 * @package RestTest\Service
 */
class CtrlMng
{
    static function registeredControllerLists()
    {
        $registeredCtrls = [
            'Ticker' => true,
            'MainPage' => true
        ];
        return $registeredCtrls;
    }

    static function defaultControllerData()
    {
        return ['controllerName' => 'Ticker', 'actionName' => 'GetAll'];
    }

    static function defaultControllerName()
    {
        return self::defaultControllerData()['controllerName'];
    }

    static function defaultControllerActionName()
    {
        return self::defaultControllerData()['actionName'];
    }

    static function mainPageControllerName()
    {
        return 'MainPage';
    }

    static function mainPageControllerActionName()
    {
        return 'Info';
    }

    static function controllerExists($crtlName)
    {
        $registeredCtrls = self::registeredControllerLists();
        return isset($registeredCtrls[$crtlName]);
    }

    /**
     * Return controller instance if controller exists else null
     *
     * @param $controllerName
     * @return BaseController|null
     */
    static function getController($controllerName)
    {
        $controllerClassName = self::getControllerClassName($controllerName);
        if (empty($controllerClassName)) {
            return null;
        }
        $res = new $controllerClassName;
        return $res;
    }

    /**
     * Return controller class name if controller with name $controllerName registred, else
     * return empty string
     *
     * @param $controllerName
     * @return string
     */
    static function getControllerClassName($controllerName)
    {
        $res = '';
        if (! self::controllerExists($controllerName)) {
            return $res;
        }
        return App::getRootControllerNamespace().'\\'.$controllerName.'Controller';
    }
}
<?php

namespace RestTest;

class App
{
    private static $appNamespace = '\RestTest';

    static function getRootModelNamespace()
    {
        return self::$appNamespace.'\Model';
    }

    static function getRootControllerNamespace()
    {
        return self::$appNamespace.'\Controller';
    }

    static function getRootViewNamespace()
    {
        return self::$appNamespace.'\View';
    }

}
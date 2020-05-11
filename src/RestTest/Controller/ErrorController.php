<?php

namespace RestTest\Controller;


use RestTest\View\Error404View;


class ErrorController
{
    public function actionError404()
    {
        header('HTTP/1.1 404 Not Found');
        $error404View = new Error404View();
        echo $error404View->run();
        exit;
    }
}
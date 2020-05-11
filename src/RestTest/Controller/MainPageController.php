<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 05.05.2020
 * Time: 0:33
 */

namespace RestTest\Controller;

use RestTest\View\MainPageView;


class MainPageController extends BaseController
{
    public function actionGET_Info()
    {
        $mainPageView = new MainPageView();
        echo $mainPageView->run();
    }
}
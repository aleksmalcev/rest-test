<?php

namespace RestTest\View;


use RestTest\Service\Route;


class MainPageView extends BaseView
{
    public function run()
    {
        $title = 'Main page';

        $pageContent = '<h1>Welcome to the RestTest application!</h1>';
        $pageContent .= '<div id="tickersHolder"><h3>Tickers</h3><div id="tickersList"></div></div> ';
        $pageContent .= '<p><input type="button" onclick="showTickers()" value="Show tickers" /></p>';

        $baseTemplate = new BaseTemplate();
        return $baseTemplate->render($title, $pageContent);
    }

}
<?php

namespace RestTest\Controller;

use RestTest\Factory\TickerFactory;


class TickerController extends BaseJsonController
{
    public function actionGET_GetAll()
    {
        try {
            $tickers = TickerFactory::getList();
            $this->replyJson($tickers);
        } catch (\Throwable $e) {
            $this->replyJsonErr($e->getMessage());
        }
    }

    public function actionGET_Search($tickerKey)
    {
        try {
            $ticker = TickerFactory::getItem($tickerKey);
            if (isset($ticker)) {
                $this->replyJson($ticker);
            } else {
                throw new \Exception('No info for key: '.$tickerKey);
            }
        } catch (\Throwable $e) {
            $this->replyJsonErr($e->getMessage());
        }
    }
}
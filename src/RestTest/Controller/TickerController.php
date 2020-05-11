<?php

namespace RestTest\Controller;

use RestTest\Factory\TickerFactory;


class TickerController extends BaseJsonController
{
    public function actionGET_GetAll()
    {
        $this->actionGET_List();
    }

    public function actionGET_Search($tickerKey)
    {
        $this->actionGET_Item($tickerKey);
    }

    public function actionGET_List()
    {
        try {
            $tickers = TickerFactory::getList();
            $this->replyJson($tickers);
        } catch (\Throwable $e) {
            $this->replyJsonErr($e->getMessage());
        }
    }

    public function actionGET_Item($tickerKey)
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

    public function actionPUT_Item($tickerKey)
    {
        try {
            throw new \Exception('Implementation needed for PUT method "Item"');
        } catch (\Throwable $e) {
            $this->replyJsonErr($e->getMessage());
        }
    }

    public function actionDELETE_Item($tickerKey)
    {
        try {
            throw new \Exception('Implementation needed for DELETE method "Item"');
        } catch (\Throwable $e) {
            $this->replyJsonErr($e->getMessage());
        }
    }

    public function actionPOST_New()
    {
        try {
            throw new \Exception('Implementation needed for POST method "New"');
        } catch (\Throwable $e) {
            $this->replyJsonErr($e->getMessage());
        }
    }
}
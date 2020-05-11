<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 09.05.2020
 * Time: 0:23
 */

namespace RestTest\Factory;


class TickerFactory
{
    static private $tickerData;
    static private $tickerKeyData;

    static private function load()
    {
        $data = file_get_contents(__DIR__.'/div.csv');
        $data = explode("\r", $data);
        return $data;
    }

    static private function parse($data)
    {
        $res = [];
        foreach ($data as $d) {
            $dArr = explode(';',$d);
            $res[] = [
                'ticker' => $dArr[0],
                'date_pay' => $dArr[1],
                'amount' => $dArr[2],
                'date_ex' => $dArr[3]
            ];
        }
        return $res;
    }

    static private function getTickers()
    {
        if (!isset(self::$tickerData)) {
            $data = self::load();
            self::$tickerData = self::parse($data);
        }
        return self::$tickerData;
    }

    static private function getTickersByKeys()
    {
        if (!isset(self::$tickerKeyData)) {
            self::$tickerKeyData = [];
            $tickers = self::getTickers();
            foreach ($tickers as $ticker) {
                $key = $ticker['ticker'];
                self::$tickerKeyData[$key] = $ticker;
            }
        }
        return self::$tickerKeyData;
    }

    static function getList()
    {
        return self::getTickers();
    }

    static function getItem($tickerKey)
    {
        $tickersByKeys = self::getTickersByKeys();
        if (isset($tickersByKeys[$tickerKey])) {
            return $tickersByKeys[$tickerKey];
        } else {
            return null;
        }
    }
}
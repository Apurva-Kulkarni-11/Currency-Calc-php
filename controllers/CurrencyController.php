<?php

include_once '../config/db.php';
include_once '../models/currency.php';

class CurrencyController {
    private $currency;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->currency = new Currency($db);
    }

    public function getRates() {
        $stmt = $this->currency->read();
        $currencies = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $exchange_rate = [];
        foreach ($currencies as $currency) {
            $exchange_rate[$currency['currency_code']] = $currency['exchange_rate'];
        }
        return $exchange_rate;
    }

    public function convert($from, $amount) {
        $exchange_rate = $this->getRates();
        $results = [];

        echo $from;
        echo $amount;
       // echo $exchange_rate;
        echo implode(" ",$exchange_rate);
        foreach ($exchange_rate as $currency_code => $exchange_rate) {
            if ($currency_code != $from) {
                $results[$currency_code] = $amount * $exchange_rate / $exchange_rate[$from];
            } else {
                $results[$currency_code] = $amount;
            }
        }

        return $results;
    }

    public function updateRates() {
        $currencies = ['usd', 'eur', 'gbp', 'aud', 'jpy'];
        
        foreach ($currencies as $base) {
            $json = file_get_contents("http://www.floatrates.com/daily/$base.json");
            $data = json_decode($json, true);

            $exchange_rate = [];
            foreach ($data as $key => $value) {
                $exchange_rate[strtoupper($key)] = $value['rate'];
            }

            $this->currency->updateRates($exchange_rate);
        }
    }
}
?>

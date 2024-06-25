<?php

class Currency {
    private $conn;
    private $table_name = "currencies";

    public $currency_code;
    public $exchange_rate;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function updateRates($rates) {
        foreach ($rates as $currency_code => $exchange_rate) {
            $query = "INSERT INTO " . $this->table_name . " (currency_code, exchange_rate) VALUES (:currency_code, :exchange_rate)
                      ON DUPLICATE KEY UPDATE exchange_rate = :exchange_rate";

            $stmt = $this->conn->prepare($query);
            $stmt->bindparam(":currency_code", $currency_code);
            $stmt->bindparam(":exchange_rate", $exchange_rate);
            $stmt->execute();
        }
    }
}
?>


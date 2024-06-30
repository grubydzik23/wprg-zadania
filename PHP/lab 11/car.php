<?php
class Car {
    public static $count = 0;
    private $model;
    private $price;
    private $exchangeRate;

    public function __construct($model, $price, $exchangeRate) {
        $this->model = $model;
        $this->price = $price;
        $this->exchangeRate = $exchangeRate;
        self::$count++;
    }

    public function getModel() {
        return $this->model;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getExchangeRate() {
        return $this->exchangeRate;
    }

    public function setExchangeRate($exchangeRate) {
        $this->exchangeRate = $exchangeRate;
    }

    public function value() {
        return $this->price * $this->exchangeRate;
    }

    public function __toString() {
        return "Model: {$this->model}, Price: {$this->price} EURO, Exchange Rate: {$this->exchangeRate} PLN";
    }
}
?>

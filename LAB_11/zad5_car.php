<?php

class Car {

    protected $model;
    protected $priceEuro;

    public function __construct($model, $priceEuro) {
        $this->model = $model;
        $this->priceEuro = $priceEuro;
    }

    public function getModel() {
        return $this->model;
    }

    public function getPriceEuro() {
        return $this->priceEuro;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function setPriceEuro($priceEuro) {
        $this->priceEuro = $priceEuro;
    }

    public function calculatePrice($rate) {
        return $this->priceEuro * $rate;
    }

    public function getType() {
        return "Car";
    }
}
<?php

require_once "Car.php";

class NewCar extends Car {

    protected $alarm;
    protected $radio;
    protected $climatronic;

    public function __construct($model, $priceEuro, $alarm, $radio, $climatronic) {

        parent::__construct($model, $priceEuro);

        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->climatronic = $climatronic;
    }

    public function hasAlarm() {
        return $this->alarm;
    }

    public function hasRadio() {
        return $this->radio;
    }

    public function hasClimatronic() {
        return $this->climatronic;
    }

    public function setAlarm($alarm) {
        $this->alarm = $alarm;
    }

    public function setRadio($radio) {
        $this->radio = $radio;
    }

    public function setClimatronic($climatronic) {
        $this->climatronic = $climatronic;
    }

    public function getType() {
        return "NewCar";
    }
}
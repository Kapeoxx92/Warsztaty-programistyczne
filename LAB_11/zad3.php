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

    public function getPrice() {
        return $this->price;
    }

    public function getExchangeRate() {
        return $this->exchangeRate;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setExchangeRate($exchangeRate) {
        $this->exchangeRate = $exchangeRate;
    }

    public function value() {

        return $this->price * $this->exchangeRate;

    }

    public function __toString() {

        return "Model: " . $this->model .
               ", Price: " . $this->price . " EURO" .
               ", Exchange Rate: " . $this->exchangeRate . " PLN";

    }
}


class NewCar extends Car {

    private $alarm;
    private $radio;
    private $climatronic;

    public function __construct(
        $model,
        $price,
        $exchangeRate,
        $alarm,
        $radio,
        $climatronic
    ) {

        parent::__construct($model, $price, $exchangeRate);

        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->climatronic = $climatronic;
    }

    public function getAlarm() {
        return $this->alarm;
    }

    public function getRadio() {
        return $this->radio;
    }

    public function getClimatronic() {
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

    public function value() {

        $value = parent::value();

        if ($this->alarm) {
            $value *= 1.05;
        }

        if ($this->radio) {
            $value *= 1.075;
        }

        if ($this->climatronic) {
            $value *= 1.10;
        }

        return $value;
    }

    // __toString()
    public function __toString() {

        return parent::__toString() .
            ", Alarm: " . ($this->alarm ? "Yes" : "No") .
            ", Radio: " . ($this->radio ? "Yes" : "No") .
            ", Climatronic: " . ($this->climatronic ? "Yes" : "No");
    }
}


// TESTY

$car1 = new Car("Model S", 50000, 4.5);

echo $car1;
echo "<br><br>";

$newCar = new NewCar(
    "Model X",
    60000,
    4.5,
    true,
    true,
    true
);

echo $newCar;
echo "<br><br>";

echo "Cena w PLN: " . $newCar->value() . " PLN";
echo "<br><br>";

echo "Liczba utworzonych samochodów: " . Car::$count;

?>
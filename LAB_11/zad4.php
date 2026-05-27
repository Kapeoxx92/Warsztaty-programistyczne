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

    public function __toString() {

        return parent::__toString() .
               ", Alarm: " . ($this->alarm ? "Yes" : "No") .
               ", Radio: " . ($this->radio ? "Yes" : "No") .
               ", Climatronic: " . ($this->climatronic ? "Yes" : "No");
    }
}


class InsuranceCar extends NewCar {

    private $firstOwner;
    private $years;

    public function __construct(
        $model,
        $price,
        $exchangeRate,
        $alarm,
        $radio,
        $climatronic,
        $firstOwner,
        $years
    ) {

        parent::__construct(
            $model,
            $price,
            $exchangeRate,
            $alarm,
            $radio,
            $climatronic
        );

        $this->firstOwner = $firstOwner;
        $this->years = $years;
    }

    // GETTERY
    public function getFirstOwner() {
        return $this->firstOwner;
    }

    public function getYears() {
        return $this->years;
    }

    // SETTERY
    public function setFirstOwner($firstOwner) {
        $this->firstOwner = $firstOwner;
    }

    public function setYears($years) {
        $this->years = $years;
    }

    public function value() {

        $value = parent::value();

        $value -= $value * (0.01 * $this->years);

        if ($this->firstOwner) {
            $value -= $value * 0.05;
        }

        return $value;
    }

    public function __toString() {

        return parent::__toString() .
               ", First Owner: " . ($this->firstOwner ? "Yes" : "No") .
               ", Years: " . $this->years;
    }
}


$car = new InsuranceCar(
    "Audi A6",
    40000,
    4.5,
    true,
    true,
    true,
    true,
    3
);

echo $car;

echo "<br><br>";

echo "Wartość samochodu po obniżkach: ";
echo $car->value() . " PLN";

echo "<br><br>";

echo "Liczba utworzonych samochodów: " . Car::$count;

?>
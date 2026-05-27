<?php

require_once "NewCar.php";

class InsuranceCar extends NewCar {

    private $firstOwner;
    private $years;

    public function __construct(
        $model,
        $priceEuro,
        $alarm,
        $radio,
        $climatronic,
        $firstOwner,
        $years
    ) {

        parent::__construct(
            $model,
            $priceEuro,
            $alarm,
            $radio,
            $climatronic
        );

        $this->firstOwner = $firstOwner;
        $this->years = $years;
    }

    public function isFirstOwner() {
        return $this->firstOwner;
    }

    public function getYears() {
        return $this->years;
    }

    public function setFirstOwner($firstOwner) {
        $this->firstOwner = $firstOwner;
    }

    public function setYears($years) {
        $this->years = $years;
    }

    public function getType() {
        return "InsuranceCar";
    }
}
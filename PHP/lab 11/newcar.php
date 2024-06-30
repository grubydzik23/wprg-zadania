<?php
class NewCar extends Car {
    private $alarm;
    private $radio;
    private $climatronic;

    public function __construct($model, $price, $exchangeRate, $alarm, $radio, $climatronic) {
        parent::__construct($model, $price, $exchangeRate);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->climatronic = $climatronic;
    }

    public function getAlarm() {
        return $this->alarm;
    }

    public function setAlarm($alarm) {
        $this->alarm = $alarm;
    }

    public function getRadio() {
        return $this->radio;
    }

    public function setRadio($radio) {
        $this->radio = $radio;
    }

    public function getClimatronic() {
        return $this->climatronic;
    }

    public function setClimatronic($climatronic) {
        $this->climatronic = $climatronic;
    }

    public function value() {
        $baseValue = parent::value();
        if ($this->alarm) {
            $baseValue *= 1.05;
        }
        if ($this->radio) {
            $baseValue *= 1.075;
        }
        if ($this->climatronic) {
            $baseValue *= 1.10;
        }
        return $baseValue;
    }

    public function __toString() {
        $features = [
            'Alarm' => $this->alarm ? 'Yes' : 'No',
            'Radio' => $this->radio ? 'Yes' : 'No',
            'Climatronic' => $this->climatronic ? 'Yes' : 'No'
        ];
        return parent::__toString() . ", Alarm: {$features['Alarm']}, Radio: {$features['Radio']}, Climatronic: {$features['Climatronic']}";
    }
}
?>

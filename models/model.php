<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

class Model {
    private $duty;

    public function __construct() {
        $this->duty = (new MongoDB\Client())->medical_center->duty;
    }

    public function getNurses() {
        return $this->duty->distinct('nurse');
    }

    public function getDutyByNurse($name) {
        return $this->duty->find(['nurse' => ['name' => htmlspecialchars($name)]])->toArray();
    }

    public function getDepartment() {
        return $this->duty->distinct('department');
    }

    public function getDutyByDepartment($name) {
        return $this->duty->find(['department' => htmlspecialchars($name)])->toArray();
    }

    public function getDutyByDepAndShift($shift, $dep) {
        return $this->duty->find(['department' => htmlspecialchars($dep), 'shift' => htmlspecialchars($shift)])->toArray();
    }
}

?>
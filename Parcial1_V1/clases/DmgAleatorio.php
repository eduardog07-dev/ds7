<?php
require_once "DmgInterface.php";

class DmgAleatorio implements DmgInterface {
    private int $min;
    private int $max;

    public function __construct(int $min, int $max) {
        $this->min = $min;
        $this->max = $max;
    }

    public function calcularDanio(): int {
        return rand($this->min, $this->max);
    }
}
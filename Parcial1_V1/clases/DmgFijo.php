<?php
require_once "DmgInterface.php";

class DmgFijo implements DmgInterface {
    private int $danio;

    public function __construct(int $danio) {
        $this->danio = $danio;
    }

    public function calcularDanio(): int {
        return $this->danio;
    }
}
<?php
require_once "DmgInterface.php";
class DmgHielo implements DmgInterface {
    private int $danioBase;

    public function __construct(int $danioBase) {
        $this->danioBase = $danioBase;
    }

    public function calcularDanio(): int {
        // El daño de hielo podría tener un efecto adicional, como reducir la velocidad del enemigo
        // Para simplificar, solo devolvemos el daño base
        return $this->danioBase;
    }
}
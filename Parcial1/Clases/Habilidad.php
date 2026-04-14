<?php
require_once "HabilidadInt.php";

abstract class Habilidad implements HabilidadInt {
    protected string $nombre;
    protected int $costo;
    protected int $danioBase;

    public function __construct($nombre, $costo, $danioBase) {
        $this->nombre = $nombre;
        $this->costo = $costo;
        $this->danioBase = $danioBase;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getCosto(): int {
        return $this->costo;
    }
}

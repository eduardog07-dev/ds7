<?php
require_once "DmgInterface.php";

class Habilidad {
    public string $nombre;
    public int $coste;
    private DmgInterface $tipoDanio;

    public function __construct(string $nombre, int $coste, DmgInterface $tipoDanio) {
        $this->nombre = $nombre;
        $this->coste = $coste;
        $this->tipoDanio = $tipoDanio;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getCoste(): int {
        return $this->coste;
    }

    public function ejecutar(): int {
        return $this->tipoDanio->calcularDanio();
    }
}
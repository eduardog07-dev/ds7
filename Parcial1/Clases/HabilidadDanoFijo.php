<?php
require_once "Habilidad.php";

class HabilidadDanoFijo extends Habilidad {
    public function ejecutar(): int {
        return $this->danioBase;
    }
}
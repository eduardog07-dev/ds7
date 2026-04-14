<?php
require_once "Habilidad.php";

class HabilidadDanoCritico extends Habilidad {
    public function ejecutar(): int {
        return rand($this->danioBase, $this->danioBase * 2);
    }
}

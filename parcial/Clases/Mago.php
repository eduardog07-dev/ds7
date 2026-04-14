<?php

require_once "Personaje.php";

class Mago extends Personaje {

    public function __construct($nombre) {
        parent::__construct($nombre, 100, 150); // más mana
    }

    // Habilidad especial del mago
    public function regenerarMana() {
        $this->mana += 20;
        echo "{$this->nombre} regeneró 20 de mana<br>";
    }
}
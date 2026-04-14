<?php

require_once "Habilidad.php";
require_once "Efecto.php";

class Personaje {

    public string $nombre;
    public int $vida;
    public int $mana;
    private array $habilidades = [];
    private array $efectos = [];

    public function __construct($nombre, $vida, $mana) {
        $this->nombre = $nombre;
        $this->vida = $vida;
        $this->mana = $mana;
    }

    // Aprender habilidad
    public function aprenderHabilidad(Habilidad $habilidad) {
        $this->habilidades[$habilidad->nombre] = $habilidad;
        echo "{$this->nombre} aprendió: {$habilidad->nombre}<br>";
    }

    // Usar habilidad
    public function usarHabilidad($nombre, Personaje $objetivo) {

        if (!$objetivo->estaVivo()) {
        echo "{$objetivo->nombre} ya está derrotado.<br>";
        return;
        }

        if (!isset($this->habilidades[$nombre])) {
            throw new Exception("Habilidad no existe");
        }

        $habilidad = $this->habilidades[$nombre];

        if ($this->mana < $habilidad->coste) {
            throw new Exception("No hay suficiente mana");
        }

        $this->mana -= $habilidad->coste;

        $danio = $habilidad->usar($objetivo);

        echo "{$objetivo->nombre} recibió {$danio} de daño. Vida restante: {$objetivo->vida}<br>";

        if (!$objetivo->estaVivo()) {
            echo "¡{$objetivo->nombre} ha sido derrotado!<br>";
        }
    }

    // Recibir daño
    public function recibirDanio($cantidad) {
        $this->vida -= $cantidad;

        if ($this->vida < 0) {
            $this->vida = 0;
        }
    }

    // Verificar si está vivo
    public function estaVivo() {
        return $this->vida > 0;
    }

    public function aplicarEfecto(Efecto $efecto) {
        $this->efectos[] = $efecto;
}

public function procesarEfectos() {

    foreach ($this->efectos as $index => $efecto) {

        $efecto->aplicar($this);

        if (!$efecto->estaActivo()) {
            unset($this->efectos[$index]);
        }
    }

        $this->efectos = array_values($this->efectos);
}
}


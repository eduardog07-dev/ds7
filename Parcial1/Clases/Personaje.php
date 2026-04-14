<?php

class Personaje {
    private string $nombre;
    private int $vida;
    private int $mana;
    private array $habilidades = [];

    public function __construct($nombre, $vida, $mana) {
        $this->nombre = $nombre;
        $this->vida = $vida;
        $this->mana = $mana;
    }

    public function agregarHabilidad($habilidad) {
        $this->habilidades[] = $habilidad;
        echo "{$this->nombre} aprendió: " . $habilidad->getNombre() . "<br>";
    }

    public function usarHabilidad($posicion, Personaje $objetivo) {
        if (!isset($this->habilidades[$posicion])) {
            throw new Exception("La habilidad no existe");
        }

        $habilidad = $this->habilidades[$posicion];

        if ($this->mana < $habilidad->getCostoMana()) {
            throw new Exception("Mana insuficiente");
        }

        $this->mana -= $habilidad->getCostoMana();

        $danio = $habilidad->ejecutar();
        $objetivo->recibirDano($danio);
    }

    public function recibirDano($danio) {
        $this->vida -= $danio;

        if ($this->vida < 0) {
            $this->vida = 0;
        }

        echo "{$this->nombre} recibió {$danio} de daño. Vida restante: {$this->vida}<br>";

        if ($this->vida <= 0) {
            echo "¡{$this->nombre} ha sido derrotado!<br>";
        }
    }
}

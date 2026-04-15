<?php
require_once "Habilidad.php";
require_once "Excepciones.php";

class Personaje {
    private string $nombre;
    private int $vida;
    private int $mana;
    private array $habilidades = [];

    public function __construct(string $nombre, int $vida, int $mana) {
        $this->nombre = $nombre;
        $this->vida = $vida;
        $this->mana = $mana;
    }

    public function getVida(): int {
        return $this->vida;
    }

    public function aprenderHabilidad(Habilidad $habilidad) {
        $this->habilidades[$habilidad->getNombre()] = $habilidad;
        echo "{$this->nombre} aprendió: {$habilidad->getNombre()}<br>";
    }

    public function usarHabilidad(string $nombre, Personaje $objetivo) {
        if (!isset($this->habilidades[$nombre])) {
            throw new HabilidadNoEncontradaException("Habilidad no encontrada");
        }

        $habilidad = $this->habilidades[$nombre];

        if ($this->mana < $habilidad->getCoste()) {
            throw new ManaInsuficienteException("Mana insuficiente");
        }

        $this->mana -= $habilidad->getCoste();

        $danio = $habilidad->ejecutar();
        $objetivo->recibirDanio($danio);
    }

    public function recibirDanio(int $danio) {
        $this->vida -= $danio;
        if ($this->vida < 0) $this->vida = 0;

        echo "{$this->nombre} recibió {$danio} de daño. Vida restante: {$this->vida}<br>";

        if (!$this->estaVivo()) {
            echo "¡{$this->nombre} ha sido derrotado!<br>";
        }
    }

    public function estaVivo(): bool {
        return $this->vida > 0;
    }
}
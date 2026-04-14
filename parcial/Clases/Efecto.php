<?php

class Efecto {

    public string $nombre;
    public int $danioPorTurno;
    public int $duracion;

    public function __construct($nombre, $danioPorTurno, $duracion) {
        $this->nombre = $nombre;
        $this->danioPorTurno = $danioPorTurno;
        $this->duracion = $duracion;
    }

    public function aplicar(Personaje $objetivo) {

        if ($this->duracion > 0) {
            $objetivo->recibirDanio($this->danioPorTurno);

            echo "{$objetivo->nombre} sufre {$this->danioPorTurno} de daño por {$this->nombre}<br>";

            $this->duracion--;
        }
    }

    public function estaActivo() {
        return $this->duracion > 0;
    }
}
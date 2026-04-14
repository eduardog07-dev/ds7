<?php

require_once "Efecto.php";
require_once "Ejecutable.php";

class Habilidad implements Ejecutable{
    public string $nombre;
    public int $coste; 
    public int $daniobase;

    public function __construct($nombre, $coste, $daniobase) {
        $this->nombre = $nombre;
        $this->coste = $coste;
        $this->daniobase = $daniobase;
    }

    public function usar($objetivo) {
        $danio = rand($this->daniobase, $this->daniobase * 2);

        $objetivo->recibirDanio($danio);

         if (rand(1, 100) <= 30) {
        $quemadura = new Efecto("Quemadura", 10, 3);
        $objetivo->aplicarEfecto($quemadura);

        echo "{$objetivo->nombre} ha sido quemado 🔥<br>";
        }

        return $danio;

    }
}
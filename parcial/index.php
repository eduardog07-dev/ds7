<?php

require_once "Clases/Personaje.php";
require_once "Clases/Mago.php";
require_once "Clases/Efecto.php";
require_once "Clases/Habilidad.php";

try {

    $gandalf = new Mago("Gandalf");
    $orco = new Personaje("Orco", 120, 0);

    $bolaFuego = new Habilidad("Bola de Fuego", 20, 50);

    $gandalf->aprenderHabilidad($bolaFuego);

    // Turno 1
    $gandalf->usarHabilidad("Bola de Fuego", $orco);
    $orco->procesarEfectos();

    echo "<hr>";

    // Turno 2
    $gandalf->usarHabilidad("Bola de Fuego", $orco);
    $orco->procesarEfectos();

    // uso de herencia
    $gandalf->regenerarMana();
    
    echo "<hr>";

    // Turno 3
    $orco->procesarEfectos();


} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
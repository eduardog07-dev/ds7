<?php
// index.php
require_once 'Interfaces/AccionCombativa.php';
require_once 'Excepciones/CombateExcepcion.php';
require_once 'Clases/Habilidad.php';
require_once 'Clases/Personaje.php';

try 
{
    // Crear personajes [cite: 9]
    $mago = new Personaje("Gandalf", 100, 50);
    $enemigo = new Personaje("Orco", 120, 0);

    // Definir y aprender habilidades [cite: 11]
    $bolaFuego = new Habilidad("Bola de Fuego", 20, 50);
    $mago->aprenderHabilidad($bolaFuego);

    // Simular combate
    echo "--- Inicio del Combate ---<br>";
    $mago->atacar("Bola de Fuego", $enemigo);
    
    if ($enemigo->estaVivo())
    {
        $mago->atacar("Bola de Fuego", $enemigo);
    }

} 
catch (CombateExcepcion $e) 
{
    echo "Error de combate: " . $e->getMessage();
}
catch (Exception $e)
{
    echo "Error inesperado: " . $e->getMessage();
}
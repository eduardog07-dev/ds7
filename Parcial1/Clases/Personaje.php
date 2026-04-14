<?php
// Clases/Personaje.php
class Personaje
{
    public string $nombre;
    public int $vida;
    public int $mana;
    private array $habilidades = [];

    public function __construct($nombre, $vida, $mana)
    {
        $this->nombre = $nombre;
        $this->vida = $vida;
        $this->mana = $mana;
    }

    // [cite: 11] Añadir una habilidad al personaje
    public function aprenderHabilidad(Habilidad $habilidad)
    {
        $this->habilidades[$habilidad->nombre] = $habilidad;
        echo "{$this->nombre} aprendió: {$habilidad->nombre}<br>";
    }

    // [cite: 12] Ejecutar la habilidad con validaciones
    public function atacar(string $nombreHabilidad, Personaje $objetivo)
    {
        // Validar si conoce la habilidad
        if (!isset($this->habilidades[$nombreHabilidad]))
        {
            throw new CombateExcepcion("{$this->nombre} no conoce la habilidad: {$nombreHabilidad}.");
        }

        $habilidad = $this->habilidades[$nombreHabilidad];

        // Validar mana
        if ($this->mana < $habilidad->coste)
        {
            throw new CombateExcepcion("{$this->nombre} no tiene suficiente mana para usar {$nombreHabilidad}.");
        }

        $this->mana -= $habilidad->coste;
        $dano = $habilidad->calcularDano();
        
        echo "{$this->nombre} usa {$nombreHabilidad} contra {$objetivo->nombre}.<br>";
        $objetivo->recibirDano($dano);
    }

    // [cite: 13] Reducir vida y mostrar mensaje
    public function recibirDano(int $cantidad)
    {
        $this->vida -= $cantidad;
        if ($this->vida < 0)
        {
            $this->vida = 0;
        }

        echo "{$this->nombre} recibió {$cantidad} de daño. Vida restante: {$this->vida}<br>";

        if (!$this->estaVivo())
        {
            echo "¡{$this->nombre} ha sido derrotado!<br>";
        }
    }

    //  Validar si el personaje tiene vida
    public function estaVivo()
    {
        return $this->vida > 0;
    }
}
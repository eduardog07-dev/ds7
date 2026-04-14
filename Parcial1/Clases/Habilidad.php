<?php
// Clases/Habilidad.php
class Habilidad implements AccionCombativa
{
    public string $nombre;
    public int $costeMana;
    protected int $danoBase;

    public function __construct($nombre, $costeMana, $danoBase)
    {
        $this->nombre = $nombre;
        $this->costeMana = $costeMana;
        $this->danoBase = $danoBase;
    }

    public function calcularDano(): int
    {
        // Implementación de daño aleatorio (Crítico) o fijo [cite: 18, 19]
        $esCritico = rand(1, 10) > 8; 
        if ($esCritico)
        {
            return (int)($this->danoBase * 1.5);
        }
        return $this->danoBase;
    }
}
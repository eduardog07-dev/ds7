<?php
require_once "../Clases/Personaje.php";
require_once "../Clases/HabilidadDannoFijo.php";
require_once "../Clases/HabilidadDanoCritico.php";

$gandalf = new Personaje("Gandalf", 100, 100);
$orco = new Personaje("Orco", 120, 50);

$bolaFuego = new HabilidadDanoFijo("Bola de Fuego", 20, 50);
$golpeCritico = new HabilidadDanoCritico("Golpe Crítico", 15, 40);
?>

<!DOCTYPE html>
<html>
<head>
    <title>RPG</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<h1>Sistema de Combate RPG</h1>

<?php
try {
    $gandalf->agregarHabilidad($bolaFuego);
    $gandalf->agregarHabilidad($golpeCritico);

    $gandalf->usarHabilidad(0, $orco);
    $gandalf->usarHabilidad(1, $orco);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

</body>
</html>

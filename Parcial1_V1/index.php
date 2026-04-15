<?php

require_once "clases/Personaje.php";
require_once "clases/Habilidad.php";
require_once "clases/DmgFijo.php";
require_once "clases/DmgAleatorio.php";
require_once "clases/DmgInterface.php";
require_once "clases/Excepciones.php";
require_once "clases/DmgHielo.php";

session_start();

// RESET MANUAL
if (isset($_POST['reset'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

// INICIALIZAR JUEGO
if (!isset($_SESSION['init'])) {

    $gandalf = new Personaje("Gandalf", 100, 100);
    $orco = new Personaje("Orco", 120, 50);

    $fuego = new Habilidad("Bola de Fuego", 20, new DmgFijo(50));
    $critico = new Habilidad("Rayo Crítico", 30, new DmgAleatorio(60, 90));
    $hielo = new Habilidad("Rayo de Hielo", 25, new DmgHielo(10, 20));

    $gandalf->aprenderHabilidad($fuego);
    $gandalf->aprenderHabilidad($critico);
    $gandalf->aprenderHabilidad($hielo);

    $_SESSION['gandalf'] = $gandalf;
    $_SESSION['orco'] = $orco;
    $_SESSION['log'] = [];
    $_SESSION['init'] = true;
}

// VIDA
$vidaG = $_SESSION['gandalf']->getVida();
$vidaO = $_SESSION['orco']->getVida();
$orcoMuerto = $vidaO <= 0;

// ACCIONES (PRG IMPLEMENTADO)
if (isset($_POST['accion']) && !$orcoMuerto) {
    try {
        $g = $_SESSION['gandalf'];
        $o = $_SESSION['orco'];

        ob_start();

        if ($_POST['accion'] == "fuego") {
            $g->usarHabilidad("Bola de Fuego", $o);
        }

        if ($_POST['accion'] == "critico") {
            $g->usarHabilidad("Rayo Crítico", $o);
        }

        if ($_POST["accion"] == "hielo") {
            $g->usarHabilidad("Rayo de Hielo", $o);
        }

        $output = ob_get_clean();
        $_SESSION['log'][] = $output;

        $_SESSION['gandalf'] = $g;
        $_SESSION['orco'] = $o;

    } catch (Exception $e) {
        $_SESSION['log'][] = "Error: " . $e->getMessage();
    }

    // 🔥 REDIRECT PARA EVITAR REENVÍO
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RPG</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<h1>⚔️ Combate RPG</h1>

<?php if ($orcoMuerto): ?>
    <h2 class="victoria">🏆 ¡Has derrotado al Orco!</h2>
<?php endif; ?>

<div class="cards">

    <!-- Gandalf -->
    <div class="card">
        <h2>🧙 Gandalf</h2>
        <div class="barra">
            <div class="vida" style="width: <?= $vidaG ?>%"></div>
        </div>
        <p>Vida: <?= $vidaG ?></p>

        <form method="POST">
            <button name="accion" value="fuego" <?= $orcoMuerto ? 'disabled' : '' ?>>
                🔥 Fuego
            </button>
            <button name="accion" value="hielo" <?= $orcoMuerto ? 'disabled' : '' ?>>
                ❄️ Hielo
            </button>

            <button name="accion" value="critico" <?= $orcoMuerto ? 'disabled' : '' ?>>
                ⚡ Crítico
            </button>
        </form>
    </div>

    <!-- Orco -->
    <div class="card">
        <h2>👹 Orco</h2>
        <div class="barra">
            <div class="vida" style="width: <?= $vidaO ?>%"></div>
        </div>
        <p>Vida: <?= $vidaO ?></p>
    </div>

</div>

<!-- LOG -->
<div class="log">
    <h3>📜 Combate</h3>
    <?php
    foreach ($_SESSION['log'] as $l) {
        echo $l . "<br>";
    }
    ?>
</div>

<!-- RESET -->
<form method="POST">
    <button name="reset">🔄 Reiniciar</button>
</form>

</body>
</html>
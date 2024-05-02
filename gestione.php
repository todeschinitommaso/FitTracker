<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestione</title>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
    body {
        padding-top: 80px;
    }
</style>
</head>
<body>

<?php
session_start();

// Controllo della sessione
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Controllo se l'utente è admin
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';


// Controllo se l'utente ha l'ID 7
$isUserId7 = isset($_SESSION['user_id']) && $_SESSION['user_id'] == 7;
?>

<div class="header">
        <a href="allenamento.php?logout=true">LOGOUT</a>
        <a href="allenamento.php">ALLENAMENTO</a>
        <a href="dieta.php">DIETA</a>
        <a href="gestione.php">GESTIONE</a>
    <?php if ($isUserId7): ?>
        <a href="utenti.php">UTENTI</a>
    <?php endif; ?>
</div>

<div class="container">
    <div class="column">
        <h2>GESTIONE ALLENAMENTO</h2>
        <div class="button-container">
            <?php if ($isAdmin): ?>
                <button onclick="window.location.href = 'aggiungi_esercizio.php';">AGGIUNGI ESERCIZIO</button>
            <?php endif; ?>
            <button onclick="window.location.href = 'aggiungi_allenamento.php';">AGGIUNGI ESERCIZIO ALL' ALLENAMENTO</button>
            <button onclick="window.location.href = 'modifica_allenamento.php';">MODIFICA ALLENAMENTO</button>
        </div>
    </div>
    <div class="vertical-line"></div>
    <div class="column">
        <h2>GESTIONE DIETA</h2>
        <?php if ($isAdmin): ?>
            <button onclick="window.location.href = 'aggiungi_alimento.php';">AGGIUNGI ALIMENTO</button>
        <?php endif; ?>
        <button onclick="window.location.href = 'aggiungi_dieta.php';">AGGIUNGI ALIMENTO ALLA DIETA</button>
        <button onclick="window.location.href = 'modifica_dieta.php';">MODIFICA DIETA</button>
    </div>
</div>

</body>
</html>

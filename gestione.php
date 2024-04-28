<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestione</title>
<style>
body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 20px;
    }
    .header {
        position: relative; /* Posizionamento relativo per il posizionamento assoluto del logout */
        text-align: center;
        margin-bottom: 20px;
    }
    .header h1 {
        margin-top: 0;
        font-size: 24px;
        color: #333;
    }
    .header a {
        padding: 10px 20px;
        margin: 0 10px;
        font-size: 18px;
        cursor: pointer;
        text-decoration: none;
        color: #4CAF50;
        border-radius: 5px;
        background-color: #f2f2f2;
        transition: background-color 0.3s;
    }
    .header a:hover {
        background-color: #e0e0e0;
    }
    .logout {
        position: absolute; /* Posizionamento assoluto rispetto all'header */
        left: -10px; /* Posizione a sinistra */
        top: 50%; /* Allineamento al centro verticalmente */
        transform: translateY(-50%); /* Correzione per centrare verticalmente */
    }
    .container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        height: 90vh;
    }
    .column {
        flex: 1;
        padding: 20px;
        text-align: center;
        margin: 20px;
    }
    .vertical-line {
        border-left: 1px solid #ccc;
        height: 90%;
        margin: auto;
    }
    .button-container {
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }
    button {
        margin-bottom: 20px;
        padding: 10px;
        font-size: 16px;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        background-color: #4CAF50;
        color: white;
        transition: background-color 0.3s;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        box-sizing: border-box;
    }
    button:hover {
        background-color: #45a049;
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
?>

<div class="header">
    <a href="allenamento.php">ALLENAMENTO</a>
    <a href="dieta.php">DIETA</a>
    <a href="gestione.php">GESTIONE</a>
    <a href="gestione.php?logout=true" class="logout">LOGOUT</a>
</div>

<div class="container">
    <div class="column">
        <h2>Gestione Allenamento</h2>
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
        <h2>Gestione Dieta</h2>
        <?php if ($isAdmin): ?>
            <button onclick="window.location.href = 'aggiungi_alimento.php';">AGGIUNGI ALIMENTO</button>
        <?php endif; ?>
        <button onclick="window.location.href = 'aggiungi_dieta.php';">AGGIUNGI ALIMENTO ALLA DIETA</button>
        <button onclick="window.location.href = 'modifica_dieta.php';">MODIFICA DIETA</button>
    </div>
</div>

</body>
</html>

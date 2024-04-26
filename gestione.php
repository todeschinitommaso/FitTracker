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
        text-align: center;
        margin-bottom: 20px;
    }
    .header h1 {
        margin-top: 0;
        font-size: 24px;
        color: #333;
    }
    .header a {
        padding: 10px;
        margin: 0 10px;
        font-size: 18px;
        cursor: pointer;
        text-decoration: none;
        color: #4CAF50;
        border-radius: 5px;
        background-color: #f2f2f2;
        transition: background-color 0.3s;
        width: 100%;
        box-sizing: border-box;
        text-align: center;
    }
    .header a:hover {
        background-color: #e0e0e0;
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

<div class="header">
    <a href="index.php">ALLENAMENTO</a>
    <a href="dieta.php">DIETA</a>
    <a href="gestione.php">GESTIONE</a>
</div>

<div class="container">
    <div class="column">
        <h2>Gestione Allenamento</h2>
        <div class="button-container">
            <button onclick="window.location.href = 'aggiungi_esercizio.php';">AGGIUNGI ESERCIZIO</button>
            <button onclick="window.location.href = 'aggiungi_allenamento.php';">AGGIUNGI ALLENAMENTO</button>
            <button onclick="window.location.href = 'modifica_esercizio.php';">MODIFICA ESERCIZIO</button>
            <button onclick="window.location.href = 'modifica_allenamento.php';">MODIFICA ALLENAMENTO</button>
        </div>
    </div>
    <div class="vertical-line"></div>
    <div class="column">
        <h2>Gestione Dieta</h2>
        <button onclick="window.location.href = 'aggiungi_alimento.php';">AGGIUNGI ALIMENTO</button>
        <button onclick="window.location.href = 'aggiungi_dieta.php';">AGGIUNGI DIETA</button>
    </div>
</div>

</body>
</html>

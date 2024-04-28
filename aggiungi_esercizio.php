<?php
session_start();

// Controlla se l'utente è loggato come amministratore
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Reindirizza alla pagina di login se non è un amministratore
    exit; // Assicura che lo script termini qui
}

// Includi il file di configurazione per la connessione al database
include 'config.php';
?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Aggiungi Esercizio</title>
<style>
 body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 20px;
    }
    .back-button {
        position: absolute;
        top: 20px;
        left: 20px;
    }
    .back-button button {
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        background-color: #4CAF50;
        color: white;
        transition: background-color 0.3s;
    }
    .back-button button:hover {
        background-color: #45a049;
    }
    .form-container {
        margin-top: 50px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    .form-container label {
        display: block;
        margin-bottom: 10px;
    }
    .form-container input[type="text"],
    .form-container select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .form-container input[type="submit"] {
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        background-color: #4CAF50;
        color: white;
        transition: background-color 0.3s;
    }
    .form-container input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>

<div class="back-button">
    <button onclick="window.location.href = 'gestione.php';">INDIETRO</button>
</div>

<div class="form-container">
<h1>AGGIUNGI ESERCIZIO</h1>
    <form method="post">
        <label for="nome_esercizio">Nome dell'esercizio:</label>
        <input type="text" name="nome_esercizio" id="nome_esercizio" required><br>
        <label for="muscolo">Muscolo:</label>
        <select name="muscolo" id="muscolo">
            <?php
                // Query per ottenere i muscoli disponibili
                $sql = "SELECT id, nome FROM muscoli";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='".$row["id"]."'>".$row["nome"]."</option>";
                    }
                } else {
                    echo "<option value=''>Nessun muscolo trovato</option>";
                }
            ?>
        </select><br>
        <input type="submit" name="submit" value="Aggiungi Esercizio">
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $nome_esercizio = $_POST['nome_esercizio'];
    $muscolo = $_POST['muscolo'];

    // Inserimento dell'esercizio nella tabella esercizi
    $sql_insert_esercizio = "INSERT INTO esercizi (nome, id_muscolo) VALUES ('$nome_esercizio', '$muscolo')";

    if ($conn->query($sql_insert_esercizio) === FALSE) {
        echo "Errore: " . $sql_insert_esercizio . "<br>" . $conn->error;
    }
}
?>

</body>
</html>

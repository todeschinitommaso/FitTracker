<?php
session_start();

// Controlla se l'utente è loggato come amministratore
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Se l'utente non è loggato o non ha il ruolo di admin, reindirizzalo alla pagina di accesso
    header("Location: login.php");
    exit; // Assicura che lo script termini dopo il reindirizzamento
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
<link rel="stylesheet" type="text/css" href="style.css">
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

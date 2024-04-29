<?php
session_start(); // Avvio della sessione

// Verifica se l'utente è loggato e ha il ruolo di admin
if (!isset($_SESSION['user_id'])) {
    // Reindirizza alla pagina di accesso se l'utente non è autenticato
    header("Location: login.php");
    exit(); // Assicura che lo script termini dopo il reindirizzamento
}

$error_message = ""; // Inizializzazione del messaggio di errore

// Verifica se il form è stato inviato
if (isset($_POST['submit'])) {
    // Recupera i dati inviati dal form
    $esercizio_id = $_POST['esercizio'];
    $serie = $_POST['serie'];
    $reps = $_POST['reps'];
    $pausa = $_POST['pausa'];
    $peso = $_POST['peso'];
    $intensita = $_POST['intensita'];
    $altro = $_POST['altro'];
    $giorni = isset($_POST['giorni']) ? $_POST['giorni'] : array(); // Gestione dei giorni selezionati

    // Controllo se è stato selezionato almeno un giorno e se è stato scelto un esercizio
    if (empty($giorni) || empty($esercizio_id)) {
        $error_message = "Si prega di selezionare almeno un giorno e un esercizio.";
    } else {
        // Includi il file di configurazione del database
        include 'config.php';

        // Recupera l'id utente dalla sessione
        $id_utente = $_SESSION['user_id'];

        // Inserimento dell'esercizio per ogni giorno selezionato nella tabella ALLENAMENTO
        foreach ($giorni as $giorno) {
            $sql_insert_allenamento = "INSERT INTO allenamento (id_utente, id_esercizio, id_giorno, serie, reps, pausa, peso, intensita, altro) 
                                       VALUES ('$id_utente', '$esercizio_id', '$giorno', '$serie', '$reps', '$pausa', '$peso', '$intensita', '$altro')";
            if ($conn->query($sql_insert_allenamento) === FALSE) {
                echo "Errore: " . $sql_insert_allenamento . "<br>" . $conn->error;
            }
        }

        $conn->close();

        // Reindirizzamento a gestione.php dopo l'aggiunta dell'allenamento
        header("Location: aggiungi_allenamento.php");
        exit(); // Assicura che lo script termini dopo il reindirizzamento
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modifica Allenamento</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="back-button">
    <button onclick="window.location.href = 'gestione.php';">INDIETRO</button>
</div>

<div class="form-container">
    <h1>AGGIUNGI ESERCIZIO</h1>
    <form method="post">
        <label for="esercizio">Scegli l'esercizio:</label>
        <select name="esercizio" id="esercizio" required>
            <option value="" selected disabled>Seleziona...</option>
            <!-- Qui ci sarà un loop per ottenere gli esercizi dal database -->
            <?php
                // Includi il file di configurazione del database
                include 'config.php';

                $sql = "SELECT id, nome FROM esercizi";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['id']."'>".$row['nome']."</option>";
                    }
                } else {
                    echo "<option value=''>Nessun esercizio trovato</option>";
                }
                $conn->close();
            ?>
        </select><br>
        <label for="serie">Serie:</label>
        <input type="number" name="serie" id="serie" required><br>
        <label for="reps">Ripetizioni:</label>
        <input type="number" name="reps" id="reps" required><br>
        <label for="pausa">Pausa (in minuti):</label>
        <input type="number" name="pausa" id="pausa" required><br>
        <label for="peso">Peso (in kg):</label>
        <input type="number" name="peso" id="peso" required><br>
        <label for="intensita">Intensità:</label>
        <input type="text" name="intensita" id="intensita" required><br>
        <label for="altro">Altro:</label>
        <input type="text" name="altro" id="altro"><br>
        <label>Giorni:</label><br>
        <input type="checkbox" name="giorni[]" id="lunedi" value="1">
        <label for="lunedi">Lunedì</label>
        <input type="checkbox" name="giorni[]" id="martedi" value="2">
        <label for="martedi">Martedì</label>
        <input type="checkbox" name="giorni[]" id="mercoledi" value="3">
        <label for="mercoledi">Mercoledì</label>
        <input type="checkbox" name="giorni[]" id="giovedi" value="4">
        <label for="giovedi">Giovedì</label>
        <input type="checkbox" name="giorni[]" id="venerdi" value="5">
        <label for="venerdi">Venerdì</label>
        <input type="checkbox" name="giorni[]" id="sabato" value="6">
        <label for="sabato">Sabato</label>
        <input type="checkbox" name="giorni[]" id="domenica" value="7">
        <label for="domenica">Domenica</label><br><br>
        <?php if (!empty($error_message)) echo "<p class='error-message'>$error_message</p>"; ?>
        <input type="submit" name="submit" class="submit-button" value="Modifica Allenamento">
    </form>
</div>

<script>
    // Aggiungi la funzionalità per selezionare i giorni con i bottoni
    document.querySelectorAll('.day-button').forEach(button => {
        button.addEventListener('click', function() {
            button.classList.toggle('active');
            const input = document.getElementById(button.textContent.toLowerCase());
            input.checked = !input.checked;
        });
    });
</script>

</body>
</html>
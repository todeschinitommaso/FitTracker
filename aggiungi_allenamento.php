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
<style>
 body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 10px;
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
    .form-container select, .form-container input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .form-container input[type="checkbox"] {
        display: none;
    }
    .form-container input[type="checkbox"] + label {
        display: inline-block;
        padding: 10px 20px;
        margin-right: 10px;
        font-size: 16px;
        cursor: pointer;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f2f2f2;
        transition: background-color 0.3s;
    }
    .form-container input[type="checkbox"]:checked + label {
        background-color: #4CAF50;
        color: white;
    }
    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 10px;
    }
    .submit-button {
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .submit-button:hover {
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
        <input type="text" name="serie" id="serie" required><br>
        <label for="reps">Ripetizioni:</label>
        <input type="text" name="reps" id="reps" required><br>
        <label for="pausa">Pausa (in secondi):</label>
        <input type="text" name="pausa" id="pausa" required><br>
        <label for="peso">Peso (in kg):</label>
        <input type="text" name="peso" id="peso" required><br>
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
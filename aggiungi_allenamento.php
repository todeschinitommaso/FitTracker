<?php
$error_message = ""; // Inizializzazione del messaggio di errore

if (isset($_POST['submit'])) {
    $esercizio_id = $_POST['esercizio'];
    $giorni = isset($_POST['giorni']) ? $_POST['giorni'] : array(); // Gestione dei giorni selezionati

    // Controllo se è stato selezionato almeno un giorno e se è stato scelto un esercizio
    if (empty($giorni) || empty($esercizio_id)) {
        $error_message = "Si prega di selezionare almeno un giorno e un esercizio.";
    } else {
        $servername = "localhost";
        $username = "ceo";
        $password = "1234";
        $dbname = "tracker";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connessione fallita: " . $conn->connect_error);
        }

        // Inserimento dell'esercizio per ogni giorno selezionato nella tabella ALLENAMENTO
        foreach ($giorni as $giorno) {
            $sql_insert_allenamento = "INSERT INTO allenamento (id_esercizio, id_giorno) VALUES ('$esercizio_id', '$giorno')";
            if ($conn->query($sql_insert_allenamento) === FALSE) {
                echo "Errore: " . $sql_insert_allenamento . "<br>" . $conn->error;
            }
        }

        $conn->close();

        // Reindirizzamento a gestione.php dopo l'aggiunta dell'allenamento
        header("Location: gestione.php");
        exit(); // Assicura che lo script termini dopo il reindirizzamento
    }
}
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
    .form-container input[type="checkbox"] {
        display: none;
    }
    .form-container input[type="checkbox"] + label {
        display: block;
        position: relative;
        padding-left: 35px;
        cursor: pointer;
        line-height: 25px;
        margin-bottom: 10px;
    }
    .form-container input[type="checkbox"] + label:before {
        content: "";
        display: block;
        position: absolute;
        left: 0;
        top: 0;
        width: 25px;
        height: 25px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        transition: background-color 0.3s;
    }
    .form-container input[type="checkbox"]:checked + label:before {
        background-color: #4CAF50;
    }
    .form-container input[type="checkbox"] + label:after {
        content: "\2713";
        font-size: 18px;
        color: #fff;
        display: none;
        position: absolute;
        top: 3px;
        left: 8px;
    }
    .form-container input[type="checkbox"]:checked + label:after {
        display: block;
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
                $servername = "localhost";
                $username = "ceo";
                $password = "1234";
                $dbname = "tracker";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connessione fallita: " . $conn->connect_error);
                }

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
        <label>Scegli i giorni:</label><br>
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
        <label for="domenica">Domenica</label>
        <br>
        <?php if (!empty($error_message)) echo "<p class='error-message'>$error_message</p>"; ?>
        <input type="submit" name="submit" class="submit-button" value="Aggiungi Allenamento">
    </form>
</div>

</body>
</html>

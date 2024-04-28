<?php
session_start();

// Verifica se l'utente ha effettuato l'accesso
if (!isset($_SESSION['user_id'])) {
    // Reindirizza alla pagina di accesso se l'utente non è autenticato
    header("Location: login.php");
    exit(); // Assicura che lo script termini dopo il reindirizzamento
}

// Include il file di configurazione del database
include 'config.php';

$error_message = ""; // Inizializzazione del messaggio di errore

// Query per ottenere tutte le categorie di alimenti dal database
$sql_categorie = "SELECT id, nome FROM categorie_alimenti";
$result_categorie = $conn->query($sql_categorie);

// Query per ottenere tutti gli alimenti dal database
$sql_alimenti = "SELECT id, nome, id_categoria FROM alimenti";
$result_alimenti = $conn->query($sql_alimenti);

// Se il modulo viene inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati dal modulo
    $pasto_id = $_POST['pasto'];
    $alimento_id = $_POST['alimento'];
    $quantita = $_POST['quantita'];
    $utente_id = $_SESSION['user_id']; // ID dell'utente loggato

    // Inserisce la dieta per ciascun giorno selezionato
    foreach ($_POST['giorni'] as $giorno) {
        // Query per inserire la nuova dieta nel database
        $sql_insert_dieta = "INSERT INTO dieta (id_utente, id_pasto, id_alimento, quantita, id_giorno) 
                             VALUES ('$utente_id', '$pasto_id', '$alimento_id', '$quantita', '$giorno')";

        if ($conn->query($sql_insert_dieta) !== TRUE) {
            $error_message = "Errore nell'aggiunta della dieta: " . $conn->error;
        }
    }

    // Reindirizza alla pagina della dieta dopo l'aggiunta della nuova dieta
    header("Location: gestione.php");
    exit(); // Assicura che lo script termini dopo il reindirizzamento
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Aggiungi Dieta</title>
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
    <h1>AGGIUNGI ALIMENTO ALLA DIETA</h1>
    <form method="post">
        <label for="pasto">Pasto:</label>
        <select name="pasto" id="pasto" required>
            <option value="" selected disabled>Seleziona...</option>
            <!-- Mostra tutti i pasti dal database -->
            <?php
                $sql_pasti = "SELECT id, nome FROM pasti";
                $result_pasti = $conn->query($sql_pasti);
                if ($result_pasti->num_rows > 0) {
                    while($row = $result_pasti->fetch_assoc()) {
                        echo "<option value='".$row['id']."'>".$row['nome']."</option>";
                    }
                } else {
                    echo "<option value=''>Nessun pasto trovato</option>";
                }
            ?>
        </select><br>
        <label for="categoria">Categoria:</label>
        <select name="categoria" id="categoria" required>
            <option value="" selected disabled>Seleziona...</option>
            <!-- Mostra tutte le categorie dal database -->
            <?php
                if ($result_categorie->num_rows > 0) {
                    while($row = $result_categorie->fetch_assoc()) {
                        echo "<option value='".$row['id']."'>".$row['nome']."</option>";
                    }
                } else {
                    echo "<option value=''>Nessuna categoria trovata</option>";
                }
            ?>
        </select><br>
        <label for="alimento">Alimento:</label>
        <select name="alimento" id="alimento" required>
            <option value="" selected disabled>Seleziona...</option>
            <!-- Mostra tutti gli alimenti dal database -->
            <?php
                if ($result_alimenti->num_rows > 0) {
                    while($row = $result_alimenti->fetch_assoc()) {
                        echo "<option value='".$row['id']."' data-categoria='".$row['id_categoria']."'>".$row['nome']."</option>";
                    }
                } else {
                    echo "<option value=''>Nessun alimento trovato</option>";
                }
            ?>
        </select><br>
        <label for="quantita">Quantità:</label>
        <input type="text" name="quantita" id="quantita" required><br>
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
        <input type="submit" class="submit-button" value="Aggiungi">
    </form>
</div>

<script>
document.getElementById("categoria").addEventListener("change", function() {
    var categoria_id = this.value;
    var alimento_select = document.getElementById("alimento");
    var alimento_options = alimento_select.getElementsByTagName("option");

    for (var i = 0; i < alimento_options.length; i++) {
        var categoria = alimento_options[i].getAttribute("data-categoria");
        if (categoria_id === "" || categoria === categoria_id) {
            alimento_options[i].style.display = "block";
        } else {
            alimento_options[i].style.display = "none";
        }
    }
});

document.getElementById("alimento").addEventListener("change", function() {
    var categoria_id = this.options[this.selectedIndex].getAttribute("data-categoria");
    document.getElementById("categoria").value = categoria_id;
});
</script>

</body>
</html>

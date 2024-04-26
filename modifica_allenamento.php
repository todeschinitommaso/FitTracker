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
        padding: 20px;
    }
    .header {
        text-align: center;
        margin-bottom: 20px;
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
    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }
    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #f0f0f0;
    }
    .day-menu {
        text-align: center;
        margin-bottom: 20px;
        padding-top: 10px;
    }
    .day-menu a {
        padding: 10px 20px;
        margin: 0 10px;
        font-size: 18px;
        cursor: pointer;
        text-decoration: none;
        color: #333;
        border-radius: 5px;
        background-color: #e0e0e0;
        transition: background-color 0.3s;
    }
    .day-menu a:hover {
        background-color: #ccc;
    }
    .delete-button {
        padding: 5px 10px;
        font-size: 14px;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        background-color: #f44336;
        color: white;
        transition: background-color 0.3s;
    }
    .delete-button:hover {
        background-color: #d32f2f;
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
</style>
</head>
<body>

<div class="back-button">
    <button onclick="window.location.href = 'gestione.php';">INDIETRO</button>
</div>

<div class="day-menu">
    <a href="modifica_allenamento.php?giorno=1">Lunedì</a>
    <a href="modifica_allenamento.php?giorno=2">Martedì</a>
    <a href="modifica_allenamento.php?giorno=3">Mercoledì</a>
    <a href="modifica_allenamento.php?giorno=4">Giovedì</a>
    <a href="modifica_allenamento.php?giorno=5">Venerdì</a>
    <a href="modifica_allenamento.php?giorno=6">Sabato</a>
    <a href="modifica_allenamento.php?giorno=7">Domenica</a>
</div>

<?php
// Connessione al database
$servername = "localhost";
$username = "ceo"; // Nome utente del database
$password = "1234"; // Password del database
$dbname = "tracker"; // Nome del database

// Creazione della connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Gestione dell'eliminazione dell'esercizio se è stato inviato l'ID dell'esercizio da eliminare
if (isset($_GET['elimina_esercizio'])) {
    $id_esercizio = $_GET['elimina_esercizio'];
    $sql_delete = "DELETE FROM allenamento WHERE id_esercizio = $id_esercizio";
    if ($conn->query($sql_delete) === TRUE) {
        // Se l'eliminazione è avvenuta con successo, ricarica la pagina
        header("Location: modifica_allenamento.php?giorno=" . $_GET['giorno']);
        exit();
    } else {
        echo "Errore nell'eliminazione dell'esercizio: " . $conn->error;
    }
}

// Determina l'id del giorno corrispondente al giorno selezionato
$giorno_selezionato = isset($_GET['giorno']) ? $_GET['giorno'] : 1; // default a Lunedì se non specificato
$giorni_settimana = array(
    1 => 'Lunedì',
    2 => 'Martedì',
    3 => 'Mercoledì',
    4 => 'Giovedì',
    5 => 'Venerdì',
    6 => 'Sabato',
    7 => 'Domenica'
);
$giorno_corrente = $giorni_settimana[$giorno_selezionato];

// Query per ottenere i dati degli esercizi per il giorno selezionato
$sql = "SELECT e.id AS id_esercizio, e.nome AS nome_esercizio, e.serie, e.reps, e.pausa, e.peso, e.intensita, m.nome AS nome_muscolo, e.altro
        FROM esercizi e
        INNER JOIN allenamento a ON e.id = a.id_esercizio
        INNER JOIN giorni g ON a.id_giorno = g.id
        INNER JOIN muscoli m ON e.id_muscolo = m.id
        WHERE g.id = $giorno_selezionato";

$result = $conn->query($sql);

// Visualizzazione della tabella con l'allenamento per il giorno selezionato
echo "<h1>Allenamento del $giorno_corrente</h1>";
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Esercizio</th>";
    echo "<th>Serie</th>";
    echo "<th>Ripetizioni</th>";
    echo "<th>Pausa</th>";
    echo "<th>Peso</th>";
    echo "<th>Intensità</th>";
    echo "<th>Muscolo</th>";
    echo "<th>Altro</th>";
    echo "<th>Azioni</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["nome_esercizio"]."</td>";
        echo "<td>".$row["serie"]."</td>";
        echo "<td>".$row["reps"]."</td>";
        echo "<td>".$row["pausa"]."</td>";
        echo "<td>".$row["peso"]."</td>";
        echo "<td>".$row["intensita"]."</td>";
        echo "<td>".$row["nome_muscolo"]."</td>";
        echo "<td>".$row["altro"]."</td>";
        echo "<td><button class='delete-button' onclick='eliminaEsercizio(".$row["id_esercizio"].")'>Elimina</button></td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>Nessun risultato trovato per il $giorno_corrente</p>";
}

$conn->close();
?>

<script>
function eliminaEsercizio(idEsercizio) {
    if (confirm("Sei sicuro di voler eliminare questo esercizio?")) {
        // Chiamata AJAX per eliminare l'esercizio
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Ricarica la pagina dopo l'eliminazione dell'esercizio
                location.reload();
            }
        };
        xhttp.open("GET", "modifica_allenamento.php?elimina_esercizio=" + idEsercizio + "&giorno=<?php echo $giorno_selezionato; ?>", true);
        xhttp.send();
    }
}
</script>

</body>
</html>

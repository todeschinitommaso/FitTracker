<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Workout</title>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
    body {
        padding-top: 100px;
        margin: 0; /* Rimuove i margini predefiniti */
        font-family: Arial, sans-serif; /* Utilizziamo un carattere leggibile */
    }

    .button-container {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 999; /* Assicura che il bottone sia in cima a tutti gli altri elementi */
    }

    .end-button {
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        margin-right: 10px;
    }

    .end-button {
        background-color: #f44336;
        color: white;
    }

    .start-button:hover, .end-button:hover {
        background-color: #f44336;
    }
</style>
</head>
<body>

<div class="header">
    <div id="timer">Tempo: 00:00</div>
    <div id="kgSollevati">KG Sollevati: 0</div>
</div>

<div id="workoutContainer">
    <?php
    session_start(); // Avvio della sessione

    // Controlla se l'utente è autenticato, altrimenti reindirizza al login
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    // Logout se il parametro logout è impostato
    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    // Ottieni il giorno corrente (1 = lunedì, 7 = domenica)
    $current_day = date('N');

    include 'config.php';

    // Query per ottenere i dati dell'allenamento dell'utente corrente relativi al giorno corrente
    $sql = "SELECT e.nome AS nome_esercizio, a.serie, a.reps, a.pausa, a.peso, a.intensita, m.nome AS nome_muscolo, a.altro
            FROM allenamento a
            INNER JOIN esercizi e ON a.id_esercizio = e.id
            INNER JOIN muscoli m ON e.id_muscolo = m.id
            WHERE a.id_utente = ? AND a.id_giorno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $current_day);
    $stmt->execute();
    $result = $stmt->get_result();

    // Controlla se la query ha prodotto risultati
    if (!$result) {
        echo "Errore nella query: " . $conn->error;
        exit();
    }

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='allenamento'>";
            echo "<h3>".$row["nome_esercizio"]."</h3>";
            echo "<p><strong>Serie:</strong> ".$row["serie"]."</p>";
            echo "<p><strong>Reps:</strong> ".$row["reps"]."</p>";
            echo "<p><strong>Pausa:</strong> ".$row["pausa"]." min</p>";
            echo "<p><strong>Peso:</strong> ".$row["peso"]." kg</p>";
            echo "<p><strong>Intensità:</strong> ".$row["intensita"]."</p>";
            echo "<p><strong>Muscolo:</strong> ".$row["nome_muscolo"]."</p>";
            echo "<p><strong>Altro:</strong> ".$row["altro"]."</p>";
            echo "</div>";
        }
    } else {
        echo "<p>Nessun risultato trovato</p>";
    }

    $conn->close();
    ?>
</div>

<div class="button-container">
    <button class="end-button" onclick="endWorkout()">TERMINA ALLENAMENTO</button>
</div>

<script>
var startTime = new Date().getTime(); // Tempo di inizio allenamento

// Aggiorna il timer ogni secondo
var timerInterval = setInterval(updateTimer, 1000);

function updateTimer() {
    var currentTime = new Date().getTime();
    var elapsedTime = currentTime - startTime;
    var minutes = Math.floor(elapsedTime / (1000 * 60));
    var seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);
    var timeString = padZero(minutes) + ":" + padZero(seconds);
    document.getElementById("timer").innerHTML = "Tempo: " + timeString;
}

function padZero(num) {
    return (num < 10 ? "0" : "") + num;
}

function endWorkout() {
    clearInterval(timerInterval); // Ferma il timer
    alert("Allenamento terminato!");
    window.location.href = "allenamento.php"; // Reindirizza alla pagina home.php
}
</script>

</body>
</html>

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

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Allenamento</title>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
    body {
        padding-top: 100px;
    }

    @media (max-width: 768px) {
        table.responsive-table th:nth-child(n+7),
        table.responsive-table td:nth-child(n+7) {
            display: none;
        }

        table.responsive-table th:nth-child(6),
        table.responsive-table td:nth-child(6) {
            display: none;
        }
    }
</style>
</head>
<body>

<div class="header">
    <a href="allenamento.php?logout=true">LOGOUT</a>
    <a href="allenamento.php">ALLENAMENTO</a>
    <a href="dieta.php">DIETA</a>
    <a href="gestione.php">GESTIONE</a>
</div>

<table class="responsive-table">
    <thead>
        <tr>
            <th>Esercizio</th>
            <th>Serie</th>
            <th>Reps</th>
            <th>Pausa</th>
            <th>Peso</th>
            <th>Intensità</th>
            <th>Muscolo</th>
            <th>Altro</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["nome_esercizio"]."</td>";
                echo "<td>".$row["serie"]."</td>";
                echo "<td>".$row["reps"]."</td>";
                echo "<td>".$row["pausa"]." min</td>";
                echo "<td>".$row["peso"]." kg</td>";
                echo "<td>".$row["intensita"]."</td>";
                echo "<td>".$row["nome_muscolo"]."</td>";
                echo "<td>".$row["altro"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Nessun risultato trovato</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dieta del Venerdì</title>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
    body {
        padding-top: 100px;
    }

    /* Aggiunti stili per rendere la tabella responsive */
    @media (max-width: 768px) {
        table.responsive-table th:nth-child(n+4),
        table.responsive-table td:nth-child(n+4) {
            display: none;
        }

        table.responsive-table th:nth-child(2),
        table.responsive-table td:nth-child(2),
        table.responsive-table th:nth-child(3),
        table.responsive-table td:nth-child(3) {
            display: table-cell;
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
            <th>Pasto</th>
            <th>Alimento</th>
            <th>Quantità</th>
            <th>Calorie</th>
            <th>Proteine</th>
            <th>Carboidrati</th>
            <th>Grassi</th>
        </tr>
    </thead>
    <tbody>
    <?php
    session_start();
    include 'config.php';

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

    $giorno_corrente = date("N");

    // Query per ottenere gli alimenti del venerdì
    $sql = "SELECT p.nome AS pasto, a.nome AS alimento, d.quantita, a.calorie, a.proteine, a.carboidrati, a.grassi
            FROM Dieta d
            INNER JOIN Giorni g ON d.id_giorno = g.id
            INNER JOIN Pasti p ON d.id_pasto = p.id
            INNER JOIN Alimenti a ON d.id_alimento = a.id
            WHERE g.id = $giorno_corrente AND d.id_utente = $user_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["pasto"]."</td>";
            echo "<td>".$row["alimento"]."</td>";
            echo "<td>".$row["quantita"]." g</td>";
            // Calcola le proporzioni
            $quantita = $row["quantita"];
            $calorie_proporzionate = round(($row["calorie"] / 100) * $quantita, 2);
            $proteine_proporzionate = round(($row["proteine"] / 100) * $quantita, 2);
            $carboidrati_proporzionati = round(($row["carboidrati"] / 100) * $quantita, 2);
            $grassi_proporzionati = round(($row["grassi"] / 100) * $quantita, 2);
            echo "<td>".$calorie_proporzionate." kcal</td>";
            echo "<td>".$proteine_proporzionate." g</td>";
            echo "<td>".$carboidrati_proporzionati." g</td>";
            echo "<td>".$grassi_proporzionati." g</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>Nessun risultato trovato</td></tr>";
    }
    $conn->close();
    ?>
    </tbody>
</table>

</body>
</html>

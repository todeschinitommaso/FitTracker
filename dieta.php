<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dieta Venerdì</title>
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
    .header h1 {
        margin-top: 0;
        font-size: 24px;
        color: #333;
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
</style>
</head>
<body>

<div class="header">
    <a href="index.php">ALLENAMENTO</a>
    <a href="dieta.php">DIETA</a>
    <a href="gestione.php">GESTIONE</a>
</div>

<h1>Dieta del <?php echo ucfirst(strftime("%A")); ?></h1>

<table>
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

// ID del venerdì
$id_venerdi = 5;

// Query per ottenere gli alimenti del venerdì
$sql = "SELECT p.nome AS pasto, a.nome AS alimento, d.quantita, a.calorie, a.proteine, a.carboidrati, a.grassi
        FROM Dieta d
        INNER JOIN Giorni g ON d.id_giorno = g.id
        INNER JOIN Pasti p ON d.id_pasto = p.id
        INNER JOIN Alimenti a ON d.id_alimento = a.id
        WHERE g.id = $id_venerdi";

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
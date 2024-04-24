<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Allenamenti</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 20px;
    }
    h1 {
        text-align: center;
        margin-bottom: 20px;
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
        padding: 12px;
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

<h1>Tabella Allenamenti</h1>

<table>
    <thead>
        <tr>
            <th>Esercizio</th>
            <th>Serie</th>
            <th>Reps</th>
            <th>Pausa</th>
            <th>Peso</th>
            <th>Intensità</th>
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

// Query per ottenere i dati degli allenamenti
$sql = "SELECT * FROM allenamento";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Per ogni esercizio nell'allenamento
        for ($i = 1; $i <= 10; $i++) {
            $esercizio_id = $row["id_es$i"];
            if ($esercizio_id != NULL) {
                // Ottieni i dati dell'esercizio dal database
                $esercizio_sql = "SELECT * FROM esercizi WHERE id = $esercizio_id";
                $esercizio_result = $conn->query($esercizio_sql);
                if ($esercizio_result->num_rows > 0) {
                    $esercizio_row = $esercizio_result->fetch_assoc();
                    echo "<tr>";
                    echo "<td>".$esercizio_row["nome"]."</td>";
                    echo "<td>".$esercizio_row["serie"]."</td>";
                    echo "<td>".$esercizio_row["reps"]."</td>";
                    echo "<td>".$esercizio_row["pausa"]."</td>";
                    echo "<td>".$esercizio_row["peso"]."</td>";
                    echo "<td>".$esercizio_row["intensita"]."</td>";
                    echo "</tr>";
                }
            }
        }
    }
} else {
    echo "<tr><td colspan='6'>Nessun risultato trovato</td></tr>";
}
$conn->close();
?>
    </tbody>
</table>

</body>
</html>

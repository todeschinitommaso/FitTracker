<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Allenamento</title>
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

<h1>Allenamento del <?php echo ucfirst(strftime("%A")); ?></h1>

<table>
    <thead>
        <tr>
            <th>Esercizio</th>
            <th>Serie</th>
            <th>Pausa</th>
            <th>Peso</th>
            <th>Intensità</th>
            <th>Muscolo</th>
            <th>Altro</th>
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

    // Determina l'id della giornata corrente (es. Venerdì)
    $giorno_corrente = date("N"); // 1 per Lunedì, 2 per Martedì, ..., 7 per Domenica

    // Query per ottenere i dati degli esercizi per la giornata corrente
    $sql = "SELECT e.nome AS nome_esercizio, e.serie, e.reps, e.pausa, e.peso, e.intensita, m.nome AS nome_muscolo, e.altro
            FROM esercizi e
            INNER JOIN allenamento a ON e.id = a.id_esercizio
            INNER JOIN giorni g ON a.id_giorno = g.id
            INNER JOIN muscoli m ON e.id_muscolo = m.id
            WHERE g.id = $giorno_corrente";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["nome_esercizio"]."</td>";
            echo "<td>".$row["serie"]." X ".$row["reps"]."</td>";
            echo "<td>".$row["pausa"]."</td>";
            echo "<td>".$row["peso"]."</td>";
            echo "<td>".$row["intensita"]."</td>";
            echo "<td>".$row["nome_muscolo"]."</td>";
            echo "<td>".$row["altro"]."</td>";
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

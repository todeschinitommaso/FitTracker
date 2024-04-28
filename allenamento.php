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
        position: relative; /* Posizionamento relativo per il contenitore header */
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
    .logout {
        position: absolute; /* Posizionamento assoluto rispetto all'header */
        left: -10px; /* Posizione a sinistra */
        top: 50%; /* Allineamento al centro verticalmente */
        transform: translateY(-50%); /* Correzione per centrare verticalmente */
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
    <a href="allenamento.php">ALLENAMENTO</a>
    <a href="dieta.php">DIETA</a>
    <a href="gestione.php">GESTIONE</a>
    <a href="allenamento.php?logout=true" class="logout">LOGOUT</a>
</div>

<h1>Allenamento del <?php echo ucfirst(strftime("%A")); ?></h1>

<table>
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

    // Query per ottenere i dati dell'allenamento dell'utente corrente
    $sql = "SELECT e.nome AS nome_esercizio, a.serie, a.reps, a.pausa, a.peso, a.intensita, m.nome AS nome_muscolo, a.altro
            FROM allenamento a
            INNER JOIN esercizi e ON a.id_esercizio = e.id
            INNER JOIN muscoli m ON e.id_muscolo = m.id
            WHERE a.id_utente = $user_id";

    $result = $conn->query($sql);

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
    $conn->close();
    ?>
    </tbody>
</table>

</body>
</html>

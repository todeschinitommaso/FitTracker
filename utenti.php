<?php
session_start(); // Avvio della sessione

// Verifica se l'utente è autenticato come amministratore
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Se l'utente non è loggato o non ha il ruolo di admin, reindirizzalo alla pagina di accesso
    header("Location: login.php");
    exit; // Assicura che lo script termini dopo il reindirizzamento
}

include 'config.php'; // Include il file di configurazione del database

// Se è stata inviata una richiesta POST per l'aggiornamento dello stato admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id']) && isset($_POST['current_admin'])) {
    // Ottieni i dati dalla richiesta POST
    $user_id = $_POST['user_id'];
    $current_admin = $_POST['current_admin'];

    // Inverti lo stato admin
    $new_admin = ($current_admin == 1) ? 0 : 1;

    // Prepara e esegui l'istruzione SQL per aggiornare lo stato admin dell'utente nel database
    $sql_update = "UPDATE utenti SET admin = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ii", $new_admin, $user_id);
    $stmt_update->execute();

    // Controlla se l'aggiornamento è avvenuto con successo
    if ($stmt_update->affected_rows > 0) {
        // Redirect per evitare il refresh del modulo POST
        header("Location: utenti.php");
        exit();
    } else {
        echo "<p>Errore durante l'aggiornamento dello stato admin dell'utente.</p>";
    }

    $stmt_update->close();
}

// Query per ottenere tutti i dati degli utenti
$sql_select = "SELECT id, username, email, nome, cognome, data_nascita, admin FROM utenti";
$result = $conn->query($sql_select);

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Elenco Utenti</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
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

button {
    padding: 8px 16px;
    font-size: 14px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #45a049;
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

<h1>Elenco degli Utenti Registrati</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Data di Nascita</th>
            <th>Admin</th>
            <th>Azioni</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Verifica se ci sono risultati dalla query
        if ($result->num_rows > 0) {
            // Iterazione sui risultati
            while($row = $result->fetch_assoc()) {
                // Stampa dei dati dell'utente in una riga della tabella
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["username"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["nome"]."</td>";
                echo "<td>".$row["cognome"]."</td>";
                echo "<td>".$row["data_nascita"]."</td>";
                echo "<td>".($row["admin"] ? 'Sì' : 'No')."</td>";
                echo "<td>";
                // Form per l'aggiornamento dello stato admin
                echo "<form method='post'>";
                echo "<input type='hidden' name='user_id' value='".$row["id"]."'>";
                echo "<input type='hidden' name='current_admin' value='".$row["admin"]."'>";
                echo "<button type='submit'>Cambia Admin</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            // Nessun utente trovato
            echo "<tr><td colspan='8'>Nessun utente trovato</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
